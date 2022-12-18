<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Game;
use App\Models\Platform;
use App\Models\Product;
use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Livewire\Component;
use Illuminate\Support\Collection;
use PhpParser\Node\Stmt\TryCatch;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductsTable extends Component
{
    public array $quantity = [];
    public $allProducts;
    public $lastProducts;
    public function mount()
    {
        $this->allProducts = Product::all();

        foreach ($this->allProducts as $product) {
            $this->quantity[$product->id] = 1;
        }
    }
    public function render()
    {
        $cart = Cart::content();
        $games = Game::latest()->paginate(4);
        $sliderProduct = Product::inRandomOrder()->take(3)->get();
        $products = Product::orderBy('discount', 'desc')->paginate(4);
        return view('livewire.products-table', compact('cart'), ['games' =>  $games, 'products' => $products, 'sliderProduct' => $sliderProduct]);
    }



    public function show(Product $product)
    {
        return view('livewire.products-show', ['product' => $product]);
    }

    public function addToCart($product)
    {
        Cart::add(
            $product["id"],
            $product["name"],
            $this->quantity[$product["id"]],
            $product["price"],
            0,
            [
                'path' => $product['path'],
                'description' => $product['description']
            ]

        );
        $this->emit('cart_updated');
    }

    public function removeFromCart(Request $request)
    {
        Cart::remove($request->input('product_rowId'));
        $cart = Cart::content();

        return view('livewire.shopping-cart', compact('cart'));
    }

    public function showCart()
    {

        $cart = Cart::content();
        return view('livewire.shopping-cart', compact('cart'));
    }


    public function checkout()
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));

        $cartItems = Cart::content();
        $line_items = [];
        $totalprice = 0;

        foreach ($cartItems as $item) {
            $totalprice += $item->price;
            $line_items[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $item->name,
                        //'images' => [$item->image], DO NOT USE ON STRIPE BECAUSE LOCALHOST
                    ],
                    'unit_amount' => $item->price,
                ],
                'quantity' => $item->qty,
            ];
        }
        $checkout_session = $stripe->checkout->sessions->create([
            'line_items' => $line_items,
            'mode' => 'payment',
            'success_url' => route('checkout.success', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url' => route('checkout.cancel', [], true),
        ]);

        $order = new Order();
        $order->status = 'unpaid';
        $order->totalPrice = $totalprice;
        $order->session_id = $checkout_session->id;
        $order->save();

        return redirect($checkout_session->url);
    }

    public function success(Request $request)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));

        $sessionId = $request->get('session_id');

        try {
            $session = $stripe->checkout->sessions->retrieve($sessionId);
            if (!$session) {
                throw new NotFoundHttpException;
            }
            $customer = $stripe->customers->retrieve($session->customer);
            $order = Order::where('session_id', $session->id)->first();
            if (!$order) {
                throw new NotFoundHttpException();
            }
            if ($order && $order->status === 'unpaid') {
                $order->status = 'paid';
                $order->save();
            }

            return view('checkout.success', compact('customer'));
        } catch (\Throwable $th) {
            throw new NotFoundHttpException();
        }
    }

    public function cancel()
    {
    }

    public function webhook()
    {
        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            return response('', 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            return response('', 400);
        }

        // Handle the event
        switch ($event->type) {
            case 'payment_intent.succeeded':
                $session = $event->data->object;
                $order = Order::where('session_id', $session->id)->first();
                if ($order &&  $order->status === 'unpaid') {
                    $order->status = 'paid';
                    $order->save();
                }

                // ... handle other event types
            default:
                echo 'Received unknown event type ' . $event->type;
        }

        return response('');
    }
}
