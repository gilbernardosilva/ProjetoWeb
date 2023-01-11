@extends('layouts.app')
@section('content')
    @livewireScripts

<div style="background-image: url(https://cdn.discordapp.com/attachments/978618862100693004/1062759853854044231/856f31d9f475501c7552c97dbe727319.png);">
    <div class="container px-0 px-lg-0 mt-5">
        <div class="card-header bg-dark">
            <div class="d-flex justify-content-center">
                <section class="py-4">
                        <input type="hidden" name="category_id" value="{{ request('category') }}">
                        <input type="hidden" name="platform_id" value="{{ request('platform') }}">
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
                </section>
            </div>
        </div>
    </div>


    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">

            <h1>Search Products</h1>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <h5 class="text-center">No Products Found!</h5>

            </div> <!-- .product-list -->
        </div>
    </section>
    <br>
    <br>
    <br>
    <br>
</div>
    @include('partials.footer')
@endsection
