@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <div class="row mb-5">
            <div class="col-6 offset-3">
                <h1 class="text-center mb-5 text-primary">Profile</h1>
                @include('partials.errors')
                @include('users.photo.edit')
                <h3 class="text-secondary">User Info</h3>
                <form method="post" action="{{ route('users.update', compact('user')) }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name', $user->name) }}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ old('email', $user->email) }}">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="password-confirm">Confirm Password</label>
                        <input type="password" class="form-control" id="password-confirm" name="password_confirmation"
                            placeholder="Password" required>
                    </div>
                    <div class="form-group mt-5">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
                <h3 class="text-secondary">Address Info</h3>

                @if($user->address)
                @php
                     $a="address.update";
                     $b="Update"
                @endphp
                   @else
                   @php
                     $a="address.store";
                     $b="Create"
                @endphp
                @endif

                <form method="post" action="{{ route($a, compact('user')) }}">
                    @csrf
                    <div class="form-group">
                        <label for="street">Street</label>
                        <input type="text" class="form-control @error('street') is-invalid @enderror" id="street"
                            name="street" value="{{ old('street', optional($user->address)->street) }}" required>
                        @error('street')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" class="form-control @error('city') is-invalid @enderror" id="city"
                                name="city" value="{{ old('city', optional($user->address)->city) }}" required>
                            @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="state">State</label>
                            <input type="text" class="form-control @error('state') is-invalid @enderror" id="state"
                                name="state" value="{{ old('state', optional($user->address)->state) }}" required>
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
                                value="{{ old('zip_code', optional($user->address)->zip_code) }}" required>
                            @error('zip_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mt-5">
                            <button type="submit" class="btn btn-primary">{{ $b }}</button>
                        </div>
                </form>
                @include('partials.errors')
            </div>
        </div>
    </div>
    </div>
@endsection
