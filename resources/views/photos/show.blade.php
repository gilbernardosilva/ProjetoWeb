@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row mb-5">
            <div class="col-6 offset-3">
                <div class="form-group">
                <h3 class="text-secondary text-center">Photo Info</h3>
                </div>
                <form>
                    <div class="form-group">
                        <img src="{{ asset('storage/images/' . $photo->path) }}" alt="Profile Photo" class="rounded img-fluid mx-auto d-block" width="160"height="90">
                    </div>
                    <div class="form-group">
                        <label for="name">ID</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name', $photo->id) }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="email">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name', $photo->name) }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="name">Path</label>
                        <input type="text" class="form-control text-cent" id="name" name="name"
                            value="{{ old('name', $photo->path) }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="email">GameID</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name', $photo->game_id) }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="name">UserID</label>
                        <input type="text" class="form-control text-cent" id="name" name="name"
                            value="{{ old('name', $photo->user_id) }}" disabled>
                    </div>
                    <div class="form-group">
                        <a class="btn btn-primary" href="/photos">Go Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

