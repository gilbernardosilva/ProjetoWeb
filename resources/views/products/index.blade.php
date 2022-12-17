@extends('layouts.app')

@section('content')
<h1 class="text-center mb-4">All Products</h1>

<div class="col lg-4">
  @foreach ($products as $product)
    <div class="col-md-3 mb-2 text-center">
      <div class="card h-100 shadow-sm rounded-lg">
        <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->name }}">
        <div class="card-body">
          <h5 class="card-title">{{ $product->game->name }}</h5>
          <p class="card-text">{{ $product->game->category->name }}</p>
          <a href="#"" class="btn btn-primary">View Product</a>
        </div>
      </div>
    </div>
  @endforeach
</div>

<div class="d-flex justify-content-center mt-4 ">
  {{ $products->links('pagination::bootstrap-4') }}
</div>
@endsection
