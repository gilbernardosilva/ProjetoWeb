@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <div class="row mb-5">
            <div class="col-6 offset-3">
                <h1 class="text-center mb-5 text-danger">Product Show</h1>
                <h2 class="text-secondary text-center">Product Info</h2>
                <form>
                    <div class="form-group">
                        <label for="name">ID</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name', $product->id) }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="email">Game</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name', $product->game->name) }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="name">SellerID</label>
                        <input type="text" class="form-control text-cent" id="name" name="name"
                            value="{{ old('name', $product->user_id) }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="name">Platform</label>
                        <input type="text" class="form-control text-cent" id="name" name="name"
                            value="{{ old('name', $product->platform_id) }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="name">Price</label>
                        <input type="text" class="form-control text-cent" id="name" name="name"
                            value="{{ old('name', $product->price) }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="name">Discount</label>
                        <input type="text" class="form-control text-cent" id="name" name="name"
                            value="{{ old('name', $product->discount) }}" disabled>
                    </div>
                    <div class="form-group">
                        <a class="btn btn-success" href="/products">Go Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
