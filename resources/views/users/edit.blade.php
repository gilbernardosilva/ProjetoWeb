@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <div class="row mb-5">
            <div class="col-6 offset-3">
                <h1 class="text-center mb-5 text-primary">Profile</h1>
                <h3 class="text-secondary">Photo</h3>
                @if ($user->photo)
                    <img src="{{ asset('storage/images/' . $user->photo->path) }}" alt="Profile Photo"
                        class="rounded img-fluid" width="160"height="90">
                @endif
                <form action="{{ route('photos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}" />
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" required class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <br>

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

                @if ($user->address)
                    @php
                        $a = "addresses.update,compact('address')";
                    @endphp
                @else
                    @php
                        $a = 'addresses.store';
                    @endphp
                @endif
                <form method="post" action="{{ $a }}">
                    @csrf
                    <div class="form-group">
                        <label for="street">Street</label>
                        <input type="text" class="form-control" id="street" name="street"
                            value="{{ old('street', optional($user->address)->street) }}" required>
                        @error('street')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city"
                                value="{{ old('city', optional($user->address)->city) }}" required>
                            @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="state">State</label>
                            <input type="text" class="form-control" id="state" name="state"
                                value="{{ old('state', optional($user->address)->state) }}" required>

                        </div>
                        <div class="form-group">
                            <label for="zip_code">Zip Code</label>
                            <input type="text" class="form-control" id="zip_code" name="zip_code"
                                value="{{ old('zip_code', optional($user->address)->zip_code) }}" required>
                            @error('zip_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mt-5">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                </form>
                @include('partials.errors')
            </div>
        </div>
    </div>
    </div>
@endsection
