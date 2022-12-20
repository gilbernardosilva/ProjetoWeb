@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <div class="row mb-5">
            <div class="col-6 offset-3">
                <h1 class="text-center mb-5 text-danger">Address Edit</h1>
                <h2 class="text-secondary text-center">Address Info</h2>
                <form method="post" action="{{ route('addresses.update', compact('address')) }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Street</label>
                        <input type="text" class="form-control" id="street" name="street"
                            value="{{ old('street', $address->street) }}">
                    </div>
                    <div class="form-group">
                        <label for="name">City</label>
                        <input type="text" class="form-control" id="city" name="city"
                            value="{{ old('city', $address->city) }}">
                    </div>
                    <div class="form-group">
                        <label for="name">State</label>
                        <input type="text" class="form-control" id="state" name="state"
                            value="{{ old('state', $address->state) }}">
                    </div>
                    <div class="form-group">
                        <label for="name">Zip-Code</label>
                        <input type="text" class="form-control" id="zip_code" name="zip_code"
                            value="{{ old('zip_code', $address->zip_code) }}">
                    </div>
                    <div class="form-group mt-5">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
                @include('partials.errors')
            </div>
        </div>
    </div>
@endsection
