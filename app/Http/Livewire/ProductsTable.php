<?php

namespace App\Http\Livewire;

use App\Mail\OrderMail;
use App\Models\Category;
use App\Models\Game;
use App\Models\Platform;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Livewire\Component;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Stmt\TryCatch;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;


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



    public function index(Request $request)
    {
        $sort = $request->input('sort');
        $search_term = request('search');
        $game = Game::where('name', 'ilike', '%' . $search_term . '%')->first();
        $paginate = $request->input('paginate');
        $products = Product::query();
        $category_id = $request->input('category_id');
        $platform_id = $request->input('platform_id');
        if (request('category_id') != null) {
            $category_id = json_decode($category_id);
            $game = Game::where('category_id', '=', $category_id)->first();
            $products = $products->where('game_id', '=', $game->id);
        } elseif (request('platform_id') != null) {
            if(!is_int(json_decode(request('platform_id')))){
                $platform_id = json_decode($platform_id);
                $platform_id = $platform_id->id;
                $products = $products->where('platform_id', '=', (int) $platform_id);
            }else{
                $platform_id = request('platform_id');
                $products = $products->where('platform_id', '=', (int) $platform_id);
            }
        } elseif ($search_term != null) {
            $products = $products->where('game_id', '=', $game->id);
        }

        // Apply sorting based on request input
        if ($sort == 'price-asc') {
            $searchProducts = $products->orderBy('price', 'asc')->paginate($paginate);
        } elseif ($sort == 'price-desc') {
            $searchProducts =  $products->orderBy('price', 'desc')->paginate($paginate);
        } elseif ($sort == 'date-asc') {
            $searchProducts =  $products->orderBy('created_at', 'asc')->paginate($paginate);
        } elseif ($sort == 'date-desc') {
            $searchProducts =  $products->latest()->paginate($paginate);
        }

        $searchProducts->appends(['search' => $search_term, 'sort' => $sort,]);

        return view('livewire.products-list', compact('searchProducts', 'category_id', 'platform_id'));
    }

    public function show(Product $product, $userID)
    {
        $category = $product->game->category->id;
        $categoryName = Category::where($category);
        $similiarProducts = Product::join('games', 'products.game_id', '=', 'games.id')
            ->where('games.category_id', $category)
            ->get()->take(4);
        $cart = Cart::content();

        $sameProduct = Product::where('game_id', $product->game->id)->paginate(4);
        return view('livewire.products-show', compact('cart', 'userID'), ['product' => $product, 'similiarProducts' => $similiarProducts, 'sameProduct' => $sameProduct]);
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

    public function searchProducts(Request $request)
    {
        $category_id = null;
        $platform_id = null;
        if ($request->search) {
            $game = Game::where('name', 'ilike', '%' . $request->search . '%')->first();
            if (!empty($game)) {
                $searchProducts = Product::where('game_id', '=', $game->id)->paginate(12);
                return view('livewire.products-list', compact('searchProducts', 'platform_id', 'category_id'));
            } else {
                return view('livewire.products-list-empty');
            }
        } else {
            return redirect()->back()->with('message', 'Empty Search');
        }
    }

    public function checkout()
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));

        $cartItems = Cart::content();
        $line_items = [];
        $totalprice = 0;

        foreach ($cartItems as $item) {
            $totalprice += $item->price - ($item->price * ($item->options->discount / 100));
            $line_items[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $item->name,
                        //'images' => [$item->image], DO NOT USE ON STRIPE BECAUSE LOCALHOST
                    ],
                    'unit_amount' => intval($item->price - ($item->price * ($item->options->discount / 100))),
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
        $order->user_id = Auth::id();
        $order->save();

        return redirect($checkout_session->url);
    }

    public function success(Request $request)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));
        $sessionId = $request->get('session_id');
        $cart = Cart::content();
        try {
            $session = $stripe->checkout->sessions->retrieve($sessionId);
            if (!$session) {
                throw new NotFoundHttpException;
            }

            $order = Order::where('session_id', $session->id)->first();
            if (!$order) {
                throw new NotFoundHttpException();
            }
            if ($order && $order->status === 'unpaid') {
                $order->status = 'paid';
            }
            $total = 0;           
            $pdf = PDF::loadView('pdfFile.pdf', [
                'cart'=>$cart, 
                'order'=>$order,
                'total'=>$total
            ]);
            $slug = Str::slug($order->created_at, '-');
            $fileName = 'invoice_' .$slug. '.pdf';
            $pdf->save(storage_path('app/public/invoices/'.$fileName));
            foreach ($cart as $product) {
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->game_id = $product->options->game_id;
                $orderItem->initial_price = $product->price;
                $orderItem->final_price = intval($product->price - ($product->price * ($product->options->discount / 100)));
                $orderItem->save();
                Product::destroy($product->id);
            }
            $order->save();               
            Cart::destroy();
            Mail::to(Auth::user()->email)->send(new OrderMail($cart, $order));

            return view('checkout.success');
        } catch (\Exception $e) {
            throw new NotFoundHttpException();
        }
    }

/*  public function pdf($cart, $order){ 
        $total = 0;    
        $pdf = PDF::loadView('pdfFile.pdf', [
                'cart'=>$cart, 
                'order'=>$order,
                'total'=>$total
        ]);
        $pdf->save(public_path('invoices/invoice.pdf'));
        return $pdf->download('invoice.pdf');
    }*/

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
