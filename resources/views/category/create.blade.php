@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add a new category</div>
                    <div class="card-body">
                        <form action="{{ url('/categories') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label for="category">Category name:</label><br>
                            <input type="text" id="category" name="category" value="{{ old('category') }}"><br>
                            <input type="submit" value="Submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
