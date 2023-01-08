<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Http;

use Livewire\Component;

class AddCart extends Component
{
    public $product_id;

    public function mount($product_id)
    {

        $this->product_id = $product_id;
    }

    public function addToCart($product_id)
    {
        $product = Product::find($product_id);
        $cart = Cart::add(
            $product->id,
            $product->game->name,
            1,
            $product->price *100,
            0,
            [
                'sellerId' => $product->user->id,
                'sellerName' => $product->user->name,
                'discount' => $product->discount,
                'path' => $product->game->photos->path,
                'game_id' => $product->game->id,
                'key' => $product->key,
            ]
        );
        //Cart::setDiscount($cart->rowId, $product->discount);
        $this->emit('cart_updated');
    }

    public function render()
    {
        $cart = Cart::content();

        return view('livewire.add-cart', compact('cart'));
    }
}
