@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="container mt-5">
            <h1 class="text-center mb-5">Profile</h1>
            <div class="row mb-5">
                <div class="col-6 offset-3">
                    <h3>Photo</h3>
                    <img src="{{ asset('images/' . $user->photo) }}" alt="Profile Photo" class="rounded img-fluid"
                        width="100" height="50">
                    <form action="{{ route('profile.updatePhotoInfo') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="inputImage"></label>
                            <input type="file" name="image" id="inputImage"
                                class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-success">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-6 offset-3">
                    <h3>User Info</h3>
                    <form method="post" action="{{ route('profile.updateUserInfo') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name', $user->name) }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" value="{{ old('email', $user->email) }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password-confirm">Confirm Password</label>
                            <input type="password" class="form-control" id="password-confirm" name="password_confirmation">
                        </div>
                        <div class="form-group mt-5">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
            @if ($address)
                <div class="row mb-5">
                    <div class="col-6 offset-3">
                        <h3>Address</h3>
                        <form method="post" action="{{ route('profile.updateAddressInfo') }}">
                            @csrf
                            <div class="form-group">
                                <label for="street">Street</label>
                                <input type="text" class="form-control @error('street') is-invalid @enderror"
                                    id="street" name="street" value="{{ old('street', $address->street) }}"
                                    required>
                                @error('street')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control @error('city') is-invalid @enderror"
                                        id="city" name="city" value="{{ old('city', $address->city) }}"
                                        required>
                                    @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <input type="text" class="form-control @error('state') is-invalid @enderror"
                                        id="state" name="state" value="{{ old('state', $address->state) }}"
                                        required>
                                    @error('state')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="zip_code">Zip Code</label>
                                    <input type="text" class="form-control @error('zip_code') is-invalid @enderror"
                                        id="zip_code" name="zip_code"
                                        value="{{ old('zip_code', $address->zip_code) }}" required>
                                    @error('zip_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
            @endif
            </form>
        </div>
    </div>
@endsection
