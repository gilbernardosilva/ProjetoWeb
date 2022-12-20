@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <div class="row mb-5">
            <div class="col-6 offset-3">
                <h1 class="text-center mb-5 text-danger">Product Edit</h1>
                <h2 class="text-secondary text-center">Product Info</h2>
                <form method="post" action="{{ route('products.update',compact('product')) }}">
                    @csrf
                    <div class="form-group">
                        <select name="game_id" id="game_id" class="form-select">
                            <option value="{{ $product->game->id }}">{{ $product->game->name }}</option>
                            @foreach ($games as $game)
                                @if($product->game->id !== $game->id)
                                <option value="{{ $game->id }}">{{ $game->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="platform_id" id="platform_id" class="form-select">
                            <option value="{{ $product->platform->id }}">{{ $product->platform->name }}</option>
                            @foreach ($platforms as $platform)
                                @if($product->platform->id !== $platform->id)
                                <option value="{{ $platform->id }}">{{ $platform->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" class="form-control" id="price" name="price"  value="{{ old('price', $product->price) }}" required>

                        </div>
                        <div class="form-group">
                            <label for="discount">Discount</label>
                            <input type="text" class="form-control" id="discount" name="discount" value="{{ old('discount', $product->discount) }}"required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Edit</button>
                        </div>
                </form>
            </div>
        </div>

    </div>

    @include('partials.errors')
@endsection
