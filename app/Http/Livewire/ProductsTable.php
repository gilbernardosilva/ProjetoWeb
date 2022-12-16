<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
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
        );
        $this->emit('cart_updated');
    }
}
