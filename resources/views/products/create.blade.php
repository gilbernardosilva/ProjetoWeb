@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <div class="row mb-5">
            <div class="col-6 offset-3">
                <h1 class="text-center mb-5 text-danger">Product Create</h1>
                <h2 class="text-secondary text-center">Product Info</h3>
                <form method="post" action="{{ route('products.store') }}">
                    @csrf
                    <div class="form-group">
                        <select name="user_id" id="user_id" class="form-select">
                            <option value="">Select a User (Optional)</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        </div>
                    <div class="form-group">
                    <select name="game_id" id="game_id" class="form-select">
                        <option value="">Select a Game</option>
                        @foreach ($games as $game)
                            <option value="{{ $game->id }}">{{ $game->name }}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="form-group">
                    <select name="platform_id" id="platform_id" class="form-select">
                        <option value="">Select a Platform</option>
                        @foreach ($platforms as $platform)
                            <option value="{{ $platform->id }}">{{ $platform->name }}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="form-group">
                        <label for="text">Price</label>
                        <input type="text" class="form-control" id="price" name="price" value="{{ old('Price') }}"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="text">Discount</label>
                        <input type="text" class="form-control" id="discount" name="discount" required>
                    </div>
                    <div class="form-group mt-5">
                        <button type="submit" class="btn btn-success">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('partials.errors')
@endsection
