@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <div class="row mb-5">
            <div class="col-6 offset-3">
                <h1 class="text-center mb-5 text-danger">Category Show</h1>
                <h2 class="text-secondary text-center">Category Info</h2>
                <form>
                    <div class="form-group">
                        <label for="name">ID</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name', $category->id) }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="email">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name', $category->name) }}" disabled>
                    </div>

                    <div class="form-group">
                        <a class="btn btn-success" href="/categories">Go Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
