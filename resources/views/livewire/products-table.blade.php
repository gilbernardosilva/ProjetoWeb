@forelse($products as $product)
<div class="product">
    <div class="inner-product">
        <div class="figure-image">
            <a href="single.html"><img src="{{ asset('storage/images/products/'.$product->path) }}" alt="{{$product->name}}"></a>
        </div>
        <h3 class="product-title"><a href="#">{{ $product->name }}</a></h3>
        <small class="price">{{$product->price}} €</small>
        <p>{{$product->description}}</p>
        @if($cart->where('id', $product->id)->count())
        In cart
        @else
        <form wire:submit.prevent="addToCart({{$product}})" action="{{ url('/')}}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{$product->id}}">
            <input type="hidden" name="product_name" value="{{$product->name}}">
            <input type="hidden" name="product_price" value="{{$product->price}}">
            <input type="hidden" name="product_quantity" wire:model="quantity.{{$product->id}}" value="1">

            <button type="submit" class="button">Add to cart</button>
        </form>
        @endif
        <a href="{{ url('/products/show/'.$product->id) }} " class="button muted">Read Details</a>
    </div>
</div> <!-- .product -->

@empty
<h5 class="text-center">No Products Found!</h5>
@endforelse
