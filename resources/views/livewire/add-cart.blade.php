<div>

    @if ($cart->where('id', $product_id)->count())
        In cart
    @else

        <button type="submit" class="btn btn-outline-dark mt-auto" wire:click="addToCart({{ $product_id }})"><i class="bi-cart-fill me-1"></i>Add to
            cart</button>
    @endif
</div>
