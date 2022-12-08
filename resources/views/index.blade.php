@extends('layouts.app')
@section('content')

<div class="home-slider">
	<ul class="slides">
		<li data-bg-image="dummy/slide-1.jpg">
			<div class="container">
				<div class="slide-content">
					<h2 class="slide-title">Kill Zone 3</h2>
					<small class="slide-subtitle">$190.00</small>

					<p>Perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur.</p>

					<a href="cart.html" class="button">Add to cart</a>
				</div>

				<img src="dummy/game-cover-1.jpg" class="slide-image">
			</div>
		</li>
		<li data-bg-image="dummy/slide-2.jpg">
			<div class="container">
				<div class="slide-content">
					<h2 class="slide-title">Kill Zone 3</h2>
					<small class="slide-subtitle">$190.00</small>

					<p>Perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur.</p>

					<a href="cart.html" class="button">Add to cart</a>
				</div>

				<img src="dummy/game-cover-2.jpg" class="slide-image">
			</div>
		</li>
		<li data-bg-image="dummy/slide-3.jpg">
			<div class="container">
				<div class="slide-content">
					<h2 class="slide-title">Kill Zone 3</h2>
					<small class="slide-subtitle">$190.00</small>

					<p>Perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur.</p>

					<a href="cart.html" class="button">Add to cart</a>
				</div>

				<img src="dummy/game-cover-3.jpg" class="slide-image">
			</div>
		</li>
	</ul> <!-- .slides -->
</div> <!-- .home-slider -->
<main class="main-content">
	<div class="container">
		<div class="page">
			<section>
				<header>
					<h2 class="section-title">New Products</h2>
					<a href="#" class="all">Show All</a>
				</header>

				<div class="product-list">
					@forelse($products as $product)
					<div class="product">
						<div class="inner-product">
							<div class="figure-image">
								<a href="single.html"><img src="{{ asset('products/'.$product->path) }}" alt="{{$product->name}}"></a>
							</div>
							<h3 class="product-title"><a href="#">{{ $product->name }}</a></h3>
							<small class="price">{{$product->price}} €</small>
							<p>{{$product->description}}</p>
							<a href="cart.html" class="button">Add to cart</a>
							<a href="#" class="button muted">Read Details</a>
						</div>
					</div> <!-- .product -->

					@empty
					<h5 class="text-center">No Products Found!</h5>
					@endforelse
				</div> <!-- .product-list -->

			</section>

			<section>
				<header>
					<h2 class="section-title">Promotion</h2>
					<a href="#" class="all">Show All</a>
				</header>

				<div class="product-list">

					<div class="product">
						<div class="inner-product">
							<div class="figure-image">
								<a href="single.html"><img src="dummy/game-5.jpg" alt="Game 1"></a>
							</div>
							<h3 class="product-title"><a href="#">Watch Dogs</a></h3>
							<small class="price">$19.00</small>
							<p>Lorem ipsum dolor sit consectetur adipiscing elit do eiusmod tempor...</p>
							<a href="cart.html" class="button">Add to cart</a>
							<a href="#" class="button muted">Read Details</a>
						</div>
					</div> <!-- .product -->


					<div class="product">
						<div class="inner-product">
							<div class="figure-image">
								<a href="single.html"><img src="dummy/game-6.jpg" alt="Game 2"></a>
							</div>
							<h3 class="product-title"><a href="#">Mortal Kombat X</a></h3>
							<small class="price">$19.00</small>
							<p>Lorem ipsum dolor sit consectetur adipiscing elit do eiusmod tempor...</p>
							<a href="cart.html" class="button">Add to cart</a>
							<a href="#" class="button muted">Read Details</a>
						</div>
					</div> <!-- .product -->


					<div class="product">
						<div class="inner-product">
							<div class="figure-image">
								<a href="single.html"><img src="dummy/game-7.jpg" alt="Game 3"></a>
							</div>
							<h3 class="product-title"><a href="#">Metal Gear Solid V</a></h3>
							<small class="price">$19.00</small>
							<p>Lorem ipsum dolor sit consectetur adipiscing elit do eiusmod tempor...</p>
							<a href="cart.html" class="button">Add to cart</a>
							<a href="#" class="button muted">Read Details</a>
						</div>
					</div> <!-- .product -->


					<div class="product">
						<div class="inner-product">
							<div class="figure-image">
								<a href="single.html"><img src="dummy/game-8.jpg" alt="Game 4"></a>
							</div>
							<h3 class="product-title"><a href="#">Nascar '14</a></h3>
							<small class="price">$19.00</small>
							<p>Lorem ipsum dolor sit consectetur adipiscing elit do eiusmod tempor...</p>
							<a href="cart.html" class="button">Add to cart</a>
							<a href="#" class="button muted">Read Details</a>
						</div>
					</div> <!-- .product -->

				</div> <!-- .product-list -->

			</section>
		</div>
	</div> <!-- .container -->
</main> <!-- .main-content -->
@endsection