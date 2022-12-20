@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <div class="row mb-5">
            <div class="col-6 offset-3">
                <h1 class="text-center mb-5 text-danger">Platform Edit</h1>
                <h2 class="text-secondary text-center">Platform Info</h2>
                <form method="post" action="{{ route('platforms.update', compact('platform')) }}">
                    @csrf
                    <div class="form-group">
                        <label for="text">Name</label>
                        <input type="name" class="form-control" id="name" name="name"
                            value="{{ old('name', $platform->name) }}" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
                @include('partials.errors')
            </div>
        </div>
    </div>
@endsection
