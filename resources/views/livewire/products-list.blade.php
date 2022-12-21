@extends('layouts.app')
@section('content')
    @include('partials.header')
    @livewireScripts



    <section class="py-4">
        <div class="container px-0 px-lg-0 mt-0">
            <label>Price:</label>
            <div class="card-body">
                <input type="radio" name="priceSort" wire:model="priceInput" value="high-to-low" /> High to Low
            </div>
            <div class="card-body">
                <input type="radio" name="priceSort" wire:model="priceInput" value="low-to-high" /> Low to High
            </div>
        </div>

    </section>
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">

            <h1>Search Products</h1>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @forelse($searchProducts as $product)
                    @php
                        if ($product->discount > 0) {
                            $sale = true;
                        } else {
                            $sale = false;
                        }
                    @endphp
                    <div class="col mb-5">
                        <div class="card h-100" style="border-top-radius:1.6rem">
                            <!-- Sale badge-->
                            @if ($sale)
                                <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">
                                    Sale</div>
                            @endif
                            <!-- Product image-->
                            <a href="{{ url('/products/show/' . $product->id . '/' . $product->user->id) }}">
                                <img class="card-img-top" style="border-top-radius:1.7rem"
                                    src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." /></a>

                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{ $product->game->name }} - [{{ $product->platform->name }}]</h5>

                                    @if ($sale)
                                        <!-- Product price-->
                                        <span class="text-muted text-decoration-line-through">{{ $product->price }}€</span>
                                        {{ number_format($product->price * ($product->discount / 100), 2, '.') }}€
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

                @empty
                    <h5 class="text-center">No Products Found!</h5>
                @endforelse

            </div> <!-- .product-list -->
        </div>
    </section>
    @include('partials.footer')
@endsection
