@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <div class="row mb-5">
            <div class="col-6 offset-3">
                <h1 class="text-center mb-5 text-danger">Platform Create</h1>
                <h2 class="text-secondary text-center">Platform Info</h2>
                <form method="POST" action="{{ route('photos.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="image">Image:</label>
                        <input type="file" name="image" id="image" required class="form-control">
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>
@include('partials.errors')
@endsection
