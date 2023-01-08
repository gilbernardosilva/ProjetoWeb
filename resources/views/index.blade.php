@extends('layouts.app')
@section('content')
    @livewireScripts()
    @include('partials.header')
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <h1>New Products</h1>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach ($products as $product)
                    @php
                        if ($product->discount > 0) {
                            $sale = true;
                        } else {
                            $sale = false;
                        }
                    @endphp
                    <div class="col mb-5">
                        <div class="card h-100" style="border-top-radius:1.6rem;">
                            <!-- Sale badge-->
                            @if ($sale)
                                <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">
                                    {{ $product->discount }} % OFF</div>
                            @endif
                            <!-- Product image-->
                            <a href="{{ url('/products/show/' . $product->id . '/' . $product->user->id) }}">
                                <img class="card-img-top" style="border-top-radius:1.7rem; height: 210px; display: block; margin: 0 auto; object-fit: cover;"
                                    src="{{ asset('storage/images/' . $product->game->photos->path) }}"
                                    alt="..." /></a>

                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h4 class="fw-bolder">{{ $product->game->name }} </h4>
                                    <h6 class="fw-bolder">{{ $product->platform->name }}</h6>
                                    @if ($sale)
                                        <!-- Product price-->
                                        <span class="text-muted text-decoration-line-through">{{ $product->price }}€</span>
                                        {{ number_format($product->price - $product->price * ($product->discount / 100), 2) }}€
                                    @else
                                        {{ $product->price }} €
                                    @endif

                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <livewire:add-cart :product_id="$product->id" />
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $products->links('pagination::bootstrap-5') }}
        </div>

        <div class="container px-4 px-lg-5 mt-5">
            <h1>Promotions</h1>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach ($productsPromo as $product)
                    @php
                        if ($product->discount > 0) {
                            $sale = true;
                        } else {
                            $sale = false;
                        }
                    @endphp
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            @if ($sale)
                                <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">
                                    {{ $product->discount }} % OFF</div>
                            @endif
                            <!-- Product image-->
                            <img class="card-img-top" style="border-top-radius:1.7rem; height: 210px; display: block; margin: 0 auto; object-fit: cover;"
                                src="{{ asset('storage/images/' . $product->game->photos->path) }}" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h4 class="fw-bolder">{{ $product->game->name }} </h4>
                                    <h6 class="fw-bolder">{{ $product->platform->name }}</h6>
                                    @if ($sale)
                                        <!-- Product price-->
                                        <span class="text-muted text-decoration-line-through">{{ $product->price }}€</span>
                                        {{ number_format($product->price - $product->price * ($product->discount / 100), 2) }}€
                                    @else
                                        {{ $product->price }}
                                    @endif

                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <livewire:add-cart :product_id="$product->id" />
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    </section>
    @include('partials.footer')
@endsection
