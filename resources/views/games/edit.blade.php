@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <div class="row mb-5">
            <div class="col-6 offset-3">
                <h1 class="text-center mb-5 text-danger">Game Edit</h1>
                <h2 class="text-secondary text-center">Game Info</h2>
                <br>
                <form method="post" action="{{ route('games.update',compact('game')) }}">
                    @csrf
                    <div class="form-group">
                    <label>Category</label>
                    <select name="category_id" id="category_id" class="form-select">
                        <option value="{{ $game->category->id }}">{{ $game->category->name }}</option>
                        @foreach ($categories as $category)
                            @if($game->category->id !== $category->id)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    </div>
                    <div class="form-group">
                        <label for="price">Name</label>
                        <input type="text" class="form-control" id="price" name="name" value="{{ old('name', $game->name) }}" required>

                    </div>
                    <div class="form-group">
                        <label for="discount">Description</label>
                        <input type="text" class="form-control" id="description" name="description" value="{{ old('description', $game->description) }}"required>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
                @include('partials.errors')
            </div>
        </div>
    </div>
@endsection
