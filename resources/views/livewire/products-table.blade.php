@livewireScripts
<div class="home-slider">
    <ul class="slides">
        @forelse($sliderProduct as $product)
            <li data-bg-image="dummy/slide-1.jpg">
                <div class="container">
                    <div class="slide-content">
                        <h2 class="slide-title">{{ $product->game->name }}</h2>
                        <small class="slide-subtitle">
                            @if ($product->discount > 0)
                                {{ ($product->discount / 100) * $product->price }}€
                            @else
                                {{ $product->price }}€
                            @endif
                        </small>

                        <p>{{ $product->game->description }}</p>

                        <livewire:add-cart :product_id="$product->id" />
                    </div>

                    <img src={{ asset('storage/images/games/' . $product->game->id . '/thumbnail') }}
                        class="slide-image">
                </div>
            </li>
        @empty
            <h5 class="text-center">No Products Found!</h5>
        @endforelse
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
                @if (session('message'))
                    <div class="alert alert-success">
                        <strong>{{ session('message') }}!</strong>
                    </div>
                @endif
                <div class="product-list">
                    @forelse($newProducts as $product)
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
                                <small class="price">{{ $product->price }} €</small>
                                <p>{{ $product->game->description }}</p>

                                <livewire:add-cart :product_id="$product->id" />
                                <a href="{{ url('/products/show/' . $product->id) }} " class="button muted">Read
                                    Details</a>
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
                    @forelse($products as $product)
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
                </div> <!-- .product-list -->

            </section>
        </div>
    </div>
</main> <!-- .main-content -->
