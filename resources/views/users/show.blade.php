@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row mb-5">
            <div class="col-6 mx-auto">
                <h1 class="text-center mb-5 text-secondary">Show User</h1>
                <form action="/user" method="get">
                    <div class="form-group mx-auto">
                        <strong>ID: </strong>
                        {{ $user->id }}
                    </div>
                    <div class="form-group mx-auto">
                        <strong>Name: </strong>
                        {{ $user->name }}
                    </div>
                    <div class="form-group mx-auto">
                        <strong>Email: </strong>
                        {{ $user->email }}
                    </div>
                        <button type="submit" class="btn btn-primary">Go Back</button>
                </form>
            </div>
        </div>
    </div>
@endsection
