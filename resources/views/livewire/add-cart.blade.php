<div>
    @if ($cart->where('id', $product_id)->count())
        In cart
    @else
        <button type="submit" class="button" wire:click="addToCart({{ $product_id }})">Add To Cart</button>
    @endif
</div>
