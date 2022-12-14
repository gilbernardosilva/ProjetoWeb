@forelse($products as $product)
<div class="product">
	<div class="inner-product">
		<div class="figure-image">
			<a href="single.html"><img src="{{ asset('storage/images/products/'.$product->path) }}" alt="{{$product->name}}"></a>
		</div>
		<h3 class="product-title"><a href="#">{{ $product->name }}</a></h3>
		<small class="price">{{$product->price}} €</small>
		<p>{{$product->description}}</p>
		<a href="cart.html" class="button">Add to cart</a>
		<a href="{{ url('/products/show/'.$product->id) }} " class="button muted">Read Details</a>
	</div>
</div> <!-- .product -->

@empty
<h5 class="text-center">No Products Found!</h5>
@endforelse