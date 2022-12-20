@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <div class="row mb-5">
            <div class="col-6 offset-3">
                <h1 class="text-center mb-5 text-danger">Address Show</h1>
                <h2 class="text-secondary text-center">Address Info</h2>
                <form>
                    <div class="form-group">
                        <label for="name">ID</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name', $address->id) }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="email">Street</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name', $address->street) }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="email">City</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name', $address->city) }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="email">State</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name', $address->state) }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="email">Zip-Code</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name', $address->zip_code) }}" disabled>
                    </div>
                    <div class="form-group">
                        <a class="btn btn-success" href="/addresses">Go Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
