@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <div class="row mb-5">
            <div class="col-6 offset-3">
                <h1 class="text-center mb-5 text-danger">Game Show</h1>
                <h2 class="text-secondary text-center">Game Info</h2>
                <form>
                    <div class="form-group">
                        <label for="name">ID</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name', $game->id) }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="email">Game</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name', $game->name) }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="name">Description</label>
                        <input type="text" class="form-control text-cent" id="name" name="name"
                            value="{{ old('name', $game->description) }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="name">Category</label>
                        <input type="text" class="form-control text-cent" id="name" name="name"
                            value="{{ old('name', $game->category->name) }}" disabled>
                    </div>
                    <div class="form-group">
                        <a class="btn btn-success" href="/games">Go Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
