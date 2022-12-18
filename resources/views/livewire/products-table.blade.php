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
                        <form wire:submit.prevent="addToCart({{ $product }})" action="{{ url('/') }}"
                            method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="product_name"
                                value="{{ $product->game->name }} - {{ $product->platform->name }}">
                            <input type="hidden" name="product_price" value="{{ $product->price }}">
                            <input type="hidden" name="product_quantity" wire:model="quantity.{{ $product->id }}"
                                value="1">

                            <button type="submit" class="button">Add to cart</button>
                        </form>
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
                    @forelse($games as $game)
                    {{$cheapest= 10000}}
                        @foreach ($game->products as $product)
                         @if ($product->price < $cheapest)
                         {{$cheapestProduct = $product}}
                         @endif
                        @endforeach
                        <div class="product">
                            <div class="inner-product">
                                <div class="figure-image">
                                    <a href="single.html"><img
                                            src="{{ asset('storage/images/games/' . $game->id . '/thumbnail') }}"
                                            alt="{{ $game->name }}"></a>
                                </div>
                                <h3 class="product-title"><a href="#">{{ $game->name }}</a></h3>
                                <small class="price">{{ $cheapestProduct->price }} €</small>
                                <p>{{ $game->description }}</p>
                                @if ($cart->where('id', $cheapestProduct->id)->count())
                                    In cart
                                @else
                                    <form wire:submit.prevent="addToCart({{ $product }})"
                                        action="{{ url('/') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $cheapestProduct->id }}">
                                        <input type="hidden" name="product_name"
                                            value="{{ $game->name }}-{{ $cheapestProduct->platform->name }}">
                                        <input type="hidden" name="product_price"
                                            value="{{ $cheapestProduct->price }}">
                                        <input type="hidden" name="product_quantity"
                                            wire:model="quantity.{{ $cheapestProduct->id }}" value="1">

                                        <button type="submit" class="button">Add to cart</button>
                                    </form>
                                @endif
                                <a href="{{ url('/products/show/' . $cheapestProduct->id) }} "
                                    class="button muted">Read Details</a>
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
                                    <a href="single.html"><img
                                            src="{{ asset('storage/images/games/' . $product->game->id . '/thumbnail') }}"
                                            alt="{{ $game->name }}"></a>
                                </div>
                                <h3 class="product-title"><a href="#">{{ $product->game->name }}</a></h3>
                                <small class="price">{{ $product->price * ($product->discount / 100) }} € - DISCOUNT:
                                    {{ $product->discount }}% </small>
                                <p>{{ $product->game->description }}</p>
                                @if ($cart->where('id', $product->id)->count())
                                    In cart
                                @else
                                    <form wire:submit.prevent="addToCart({{ $product }})"
                                        action="{{ url('/') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="product_name" value="{{ $product->game->name }}">
                                        <input type="hidden" name="product_price"
                                            value="{{ $product->price * ($product->discount / 100) }}">
                                        <input type="hidden" name="product_quantity"
                                            wire:model="quantity.{{ $product->id }}" value="1">

                                        <button type="submit" class="button">Add to cart</button>
                                    </form>
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
