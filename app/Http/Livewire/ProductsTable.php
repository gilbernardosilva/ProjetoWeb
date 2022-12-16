<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Livewire\Component;

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
        return view('livewire.products-table', compact('cart'), ['products' => Product::latest()->paginate(4)]);
    }

    public function addToCart($product)
    {
        Cart::add(
            $product["id"],
            $product["name"],
            $this->quantity[$product["id"]],
            $product["price"],
            0,
            ['path' => $product['path'],
            'description' => $product['description']
            ]

        );
        $this->emit('cart_updated');
    }

    public function removeFromCart(Request $request){
        Cart::remove($request->input('product_rowId'));
        $cart = Cart::content();

        return view('livewire.shopping-cart', compact('cart'));
    }

    public function showCart()
    {

        $cart = Cart::content();
        return view('livewire.shopping-cart', compact('cart'));
    }
}
