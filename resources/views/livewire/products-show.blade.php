@extends('layouts.app')
@section('content')
    <div class="breadcrumbs">
        <div class="container">
            <a href="index.html">Home</a>
            <a href="products.html">{{ $product->game->categories->category }}</a>
            <span>{{ $product->game->name }}</span>
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
                                    <a href="{{ asset('storage/images/products/') }}">
                                        <img src="{{ asset('storage/images/products/') }}" alt="{{ $product->game->name }}">
                                    </a>
                                </figure>
                                <div class="thumbnails">
                                    <a href="dummy/image-2.jpg"><img src="{{ asset('storage/images/products/') }}"
                                            alt=""></a>
                                    <a href="dummy/image-3.jpg"><img src="{{ asset('storage/images/products/') }}"
                                            alt=""></a>
                                    <a href="dummy/image-4.jpg"><img src="{{ asset('storage/images/products/') }}"
                                            alt=""></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-8">
                            <h2 class="entry-title">{{ $product->game->name }}</h2>
                            <small class="price">
                                @if ($product->discount > 0)
                                    {{ ($product->discount / 100) * $product->price }}€
                                @else
                                    {{ $product->price }}€
                                @endif
                            </small>

                            <p>{{ $product->game->description }}</p>

                            <div class="addtocart-bar">
                                <livewire:add-cart :product_id="$product->id" />

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
                        @forelse($similiarProducts as $product)
                            <div class="product">
                                <div class="inner-product">
                                    <div class="figure-image">
                                        <a href="{{ url('/products/show/' . $product->id) }}"><img
                                                src="{{ asset('storage/images/games/' . $product->game->id . '/thumbnail') }}"
                                                alt="{{ $product->game->name }}"></a>
                                    </div>
                                    <h3 class="product-title"><a
                                            href="{{ url('/products/show/' . $product->id) }}">{{ $product->game->name }}</a>
                                    </h3>
                                    <small class="price">{{ $product->price * ($product->discount / 100) }} € - DISCOUNT:
                                        {{ $product->discount }}% </small>
                                    <p>{{ $product->game->description }}</p>
                                    @if ($cart->where('id', $product->id)->count())
                                        In cart
                                    @else
                                        <livewire:add-cart :product_id="$product->id" />
                                    @endif

                                    <a href="{{ url('/products/show/' . $product->id) }} " class="button muted">Read
                                        Details</a>
                                </div>
                            </div> <!-- .product -->
                        @empty
                            <h5 class="text-center">No Products Found!</h5>
                        @endforelse
                    </div>

                </section>


            </div>
        </div> <!-- .container -->
    </main> <!-- .main-content -->
@endsection
