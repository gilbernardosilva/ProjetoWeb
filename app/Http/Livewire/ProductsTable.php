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
    public $productId;
    public $allProducts;
    public $lastProducts;

    public function mount()
    {
        $this->allProducts = Product::all();
    }

    public function render()
    {
        $cart = Cart::content();
        $newProducts = Product::latest()->paginate(4);
        $sliderProduct = Product::inRandomOrder()->take(3)->get();
        $products = Product::orderBy('discount', 'desc')->paginate(4);
        return view('livewire.products-table', compact('cart'), ['newProducts' =>  $newProducts, 'products' => $products, 'sliderProduct' => $sliderProduct]);
    }



    public function show(Product $product)
    {
        $category = $product->game->categories->id;
        $categoryName = Category::where($category);
        $similiarProducts = Product::join('games', 'products.game_id', '=', 'games.id')
        ->where('games.categories_id', $category)
        ->get()->take(4);
        $cart = Cart::content();

        $sameProduct = Product::where('game_id', $product->game->id)->paginate(4);
        return view('livewire.products-show', compact('cart'),['product' => $product, 'similiarProducts' => $similiarProducts, 'sameProduct' => $sameProduct]);
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
            $cartItems = Cart::content();
            foreach ($cartItems as $product) {
                Product::destroy($product->id);
            }
            Cart::destroy();

            return view('checkout.success', compact('customer'));
        } catch (\Throwable $th) {
            throw new NotFoundHttpException();
        }
    }

    public function cancel()
    {

        return view('/');
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
