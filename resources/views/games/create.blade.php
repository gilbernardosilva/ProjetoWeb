@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <div class="row mb-5">
            <div class="col-6 offset-3">
                <h1 class="text-center mb-5 text-danger">Game Create</h1>
                <h2 class="text-secondary text-center">Game Info</h2>
                <br>
                <form method="post" action="{{ route('games.store') }}">
                    @csrf
                    <div class="form-group">
                    <label>Category</label>
                    <select name="category_id" id="category_id" class="form-select">
                        <option value="">Select a Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="name">Description</label>
                        <input type="text" class="form-control" id="description" name="description">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Create</button>
                    </div>
                </form>
                @include('partials.errors')
            </div>
        </div>
    </div>
@endsection
