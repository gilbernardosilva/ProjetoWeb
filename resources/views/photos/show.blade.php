@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row mb-5">
            <div class="col-6 mx-auto">
                <h1 class="text-center mb-5 text-secondary">Show Photo</h1>
                <form action="/photo" method="get">
                    <div class="form-group mx-auto">
                        <img src="{{ asset('storage/images/' . $photo->path) }}" alt="Profile Photo" class="rounded img-fluid" width="160"height="90">
                    </div>
                    <div class="form-group mx-auto">
                        <strong>ID: </strong>
                        {{ $photo->id }}
                    </div>
                    <div class="form-group mx-auto">
                        <strong>Name: </strong>
                        {{ $photo->name }}
                    </div>
                    <div class="form-group mx-auto">
                        <strong>Path: </strong>
                        {{ $photo->path }}
                    </div>
                    <div class="form-group mx-auto">
                        <strong>User-ID: </strong>
                        {{ $photo->user_id }}
                    </div>
                    <div class="form-group mx-auto">
                        <strong>Game-id: </strong>
                        {{ $photo->game_id }}
                    </div>
                    <button type="submit" class="btn btn-primary">Go Back</button>
                </form>
            </div>
        </div>
    </div>
@endsection
