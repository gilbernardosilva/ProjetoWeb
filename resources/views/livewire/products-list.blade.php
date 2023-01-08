@extends('layouts.app')
@section('content')
    @livewireScripts


    <div class="container px-0 px-lg-0 mt-5">
        <div class="card-header bg-dark">
            <div class="d-flex justify-content-center">
                <section class="py-4">
                    <form action="{{ route('product.sort') }}" method="GET">
                        <input type="hidden" name="category_id" value="{{ $category_id }}">
                        <input type="hidden" name="platform_id" value="{{ $platform_id }}">
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        <label for="sort" class="text-white">Sort by:</label>
                        <select name="sort" id="sort">
                            <option value="price-asc">Price (Low to High)</option>
                            <option value="price-desc">Price (High to Low)</option>
                            <option value="date-asc">Date (Old to New)</option>
                            <option value="date-desc">Date (New to Old)</option>
                        </select>
                        <label for="paginate" class="text-white">Items per page:</label>
                        <input type="text" name="paginate" id="paginate" value="10">
                        <button type="submit">Filter</button>
                    </form>
                </section>
            </div>
        </div>
    </div>


    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">

            <h1></h1>
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
                                    {{ $product->discount }} % OFF</div>
                            @endif
                            <!-- Product image-->
                            <a href="{{ url('/products/show/' . $product->id . '/' . $product->user->id) }}">
                                <img class="card-img-top"
                                    style="border-top-radius:1.7rem; height: 210px; display: block; margin: 0 auto; object-fit: cover;"
                                    src="{{ asset('storage/images/' . $product->game->photos->path) }}"
                                    alt="..." /></a>

                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{ $product->game->name }} - [{{ $product->platform->name }}]
                                    </h5>

                                    @if ($sale)
                                        <!-- Product price-->
                                        <span class="text-muted text-decoration-line-through">{{ $product->price }}€</span>
                                        {{ intval($product->price * 100 - $product->price * 100 * ($product->discount / 100)) / 100 }}€
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

                @empty
                    <h5 class="text-center">No Products Found!</h5>
                @endforelse

            </div> <!-- .product-list -->
            {{ $searchProducts->appends(request()->input())->links('pagination::bootstrap-5') }}
        </div>
    </section>
    <br>
    <br>
    <br>
    <br>
    @include('partials.footer')
@endsection
