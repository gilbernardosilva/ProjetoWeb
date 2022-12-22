@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <div class="row mb-5">
            <div class="col-6 offset-3">
                <h1 class="text-center mb-5 text-danger">Become a Seller</h1>
                <form method="post" action="{{ route('user.storeSeller') }}">
                    @csrf
                    @if(!Auth::user()->address)
                    <div class="form-group">
                        <label for="name">Street</label>
                        <input type="text" class="form-control" id="street" name="street">
                    </div>
                    <div class="form-group">
                        <label for="name">City</label>
                        <input type="text" class="form-control" id="city" name="city">
                    </div>
                    <div class="form-group">
                        <label for="name">State</label>
                        <input type="text" class="form-control" id="state" name="state">
                    </div>
                    <div class="form-group">
                        <label for="name">Zip-Code</label>
                        <input type="text" class="form-control" id="zip_code" name="zip_code">
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="name">Nif</label>
                        <input type="text" class="form-control" id="nif" name="nif">
                    </div>
                    <div class="form-group mt-5">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
                @include('partials.errors')
            </div>
        </div>
    </div>
@endsection
