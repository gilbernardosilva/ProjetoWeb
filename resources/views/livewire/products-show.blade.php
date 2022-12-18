@extends('layouts.app')
@section('content')
<div class="breadcrumbs">
	<div class="container">
		<a href="index.html">Home</a>
		<a href="products.html">{{ $product->game()->category()->category }}</a>
		<span>{{ $product->game()->name }}</span>
	</div>
</div>
</div> <!-- .container -->
</div> <!-- .site-header -->

<main class="main-content">
	<div class="container">
		<div class="page">

			<div class="entry-content">
				<div class="row">
					<div class="col-sm-6 col-md-4">
						<div class="product-images">
							<figure class="large-image">
								<a href="{{ asset('storage/images/products/'.$product->path) }}">
									<img src="{{ asset('storage/images/products/'.$product->path) }}" alt="{{$product->game()->name}}">
								</a>
							</figure>
							<div class="thumbnails">
								<a href="dummy/image-2.jpg"><img src="{{ asset('storage/images/products/'.$product->path) }}" alt=""></a>
								<a href="dummy/image-3.jpg"><img src="{{ asset('storage/images/products/'.$product->path) }}" alt=""></a>
								<a href="dummy/image-4.jpg"><img src="{{ asset('storage/images/products/'.$product->path) }}" alt=""></a>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-8">
						<h2 class="entry-title">{{ $product->game()->name }}</h2>
						<small class="price">     @if ($product->discount > 0)
                            {{ ($product->discount / 100) * $product->price }}€
                        @else
                            {{ $product->price }}€
                        @endif </small>

						<p>{{ $product->game()->description }}</p>

						<div class="addtocart-bar">
							<form wire:submit.prevent="addToCart({{ $product }})" action="{{ url('/') }}"
                            method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="product_name"
                                value="{{ $product->game()->name - $product->game()->platform()->name }}">
                            <input type="hidden" name="product_price" value="{{ $product->price }}">
                            <input type="hidden" name="product_quantity" wire:model="quantity.{{ $product->id }}"
                                value="1">

                            <button type="submit" class="button">Add to cart</button>
                        </form>

							<div class="social-links square">
								<strong>Share</strong>
								<a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
								<a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
								<a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
								<a href="#" class="pinterest"><i class="fa fa-pinterest"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>

			<section>
				<header>
					<h2 class="section-title">Similiar Product</h2>
				</header>
				<div class="product-list">
					<div class="product">
						<div class="inner-product">
							<div class="figure-image">
								<img src="dummy/game-1.jpg" alt="Game 1">
							</div>
							<h3 class="product-title"><a href="#">Alpha Protocol</a></h3>
							<small class="price">$20.00</small>
							<p>Lorem ipsum dolor sit consectetur adipiscing elit do eiusmod tempor...</p>
							<a href="#" class="button">Add to cart</a>
							<a href="#" class="button muted">Read Details</a>
						</div>
					</div> <!-- .product -->

					<div class="product">
						<div class="inner-product">
							<div class="figure-image">
								<img src="dummy/game-2.jpg" alt="Game 2">
							</div>
							<h3 class="product-title"><a href="#">Grand Theft Auto V</a></h3>
							<small class="price">$20.00</small>
							<p>Lorem ipsum dolor sit consectetur adipiscing elit do eiusmod tempor...</p>
							<a href="#" class="button">Add to cart</a>
							<a href="#" class="button muted">Read Details</a>
						</div>
					</div> <!-- .product -->

					<div class="product">
						<div class="inner-product">
							<div class="figure-image">
								<img src="dummy/game-3.jpg" alt="Game 3">
							</div>
							<h3 class="product-title"><a href="#">Need for Speed rivals</a></h3>
							<small class="price">$20.00</small>
							<p>Lorem ipsum dolor sit consectetur adipiscing elit do eiusmod tempor...</p>
							<a href="#" class="button">Add to cart</a>
							<a href="#" class="button muted">Read Details</a>
						</div>
					</div> <!-- .product -->

					<div class="product">
						<div class="inner-product">
							<div class="figure-image">
								<img src="dummy/game-4.jpg" alt="Game 4">
							</div>
							<h3 class="product-title"><a href="#">Big game hunter</a></h3>
							<small class="price">$20.00</small>
							<p>Lorem ipsum dolor sit consectetur adipiscing elit do eiusmod tempor...</p>
							<a href="#" class="button">Add to cart</a>
							<a href="#" class="button muted">Read Details</a>
						</div>
					</div> <!-- .product -->

				</div> <!-- .product-list -->
			</section>


		</div>
	</div> <!-- .container -->
</main> <!-- .main-content -->
@endsection
