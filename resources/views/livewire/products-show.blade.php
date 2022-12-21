@extends('layouts.app')
@section('content')
    <!-- Product section-->
    @php
        if ($product->discount > 0) {
            $sale = true;
        } else {
            $sale = false;
        }
    @endphp
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0"
                        src="https://dummyimage.com/600x700/dee2e6/6c757d.jpg" alt="..." /></div>
                <div class="col-md-6">
                    <div class="small mb-1">SKU: {{ $product->id }}</div>
                    <h1 class="display-5 fw-bolder">{{ $product->game->name }}</h1>
                    <div class="fs-5 mb-5">
                        @if ($sale)
                            <span class="text-decoration-line-through">{{ $product->price }}€</span>
                            <span>{{ number_format($product->price * ($product->discount / 100), 2, '.') }}€</span>
                        @else
                            <span>{{ $product->price }}€</span>
                        @endif
                        <div class="small mb-1">
                            Seller:<a class="small mb-1"> {{ $product->user->name }}</a>
                        </div>
                    </div>


                    <p class="lead">{{ $product->game->description }}</p>
                    <div class="d-flex">
                        <livewire:add-cart :product_id="$product->id" />
                    </div>
                </div>
            </div>
        </div>
        <div class="card align-items-center"
            style="width: 18rem display: flex; align-items: center; justify-content: center; width: 300px; height: 300px; background-color: lightblue;">
            <div class="card-header">
                Other Sellers
            </div>
            @forelse ($sameProduct as $productSeller)
                @if ($productSeller->user->id == $product->user->id)
                @else
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <livewire:add-cart :product_id="$productSeller->id" />
                            <div class="small mb-1">
                                Seller:<a class="small mb-1"> {{ $product->user->name }}</a>
                            </div>
                            <strong>Price</strong>
                            @if ($productSeller->discount > 0)
                                {{ ($productSeller->discount / 100) * $productSeller->price }}€
                            @else
                                {{ $productSeller->price }}€
                            @endif
                        </li>
                    </ul>
                @endif
            @empty
                <p>No other sellers</p>
            @endforelse
            {{ $sameProduct->links('pagination::semantic-ui') }}
        </div>
    </section>
    <!-- Related items section-->
    <section class="py-5 bg-light">
        <div class="container px-4 px-lg-5 mt-5">
            <h2 class="fw-bolder mb-4">Related products</h2>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @forelse ($similiarProducts as $product)
                    @php
                        if ($product->discount > 0) {
                            $sale = true;
                        } else {
                            $sale = false;
                        }
                    @endphp
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <a href="{{ url('/products/show/' . $product->id . '/' . $product->user->id) }}">
                                <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg"
                                    alt="..." /></a>
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{ $product->game->name }}</h5>
                                    @if ($sale)
                                        <!-- Product price-->
                                        <span class="text-muted text-decoration-line-through">{{ $product->price }}€</span>
                                        {{ number_format($product->price * ($product->discount / 100), 2, '.') }}€
                                    @else
                                        {{ $product->price }}€
                                    @endif
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <livewire:add-cart :product_id="$product->id" />
                            </div>
                        </div>
                    </div>
                @empty
                    NO PRODUCTS
                @endforelse
            </div>
        </div>
    </section>
@include('partials.footer')
@endsection

