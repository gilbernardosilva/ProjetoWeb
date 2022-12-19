@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <div class="row mb-5">
            <div class="col-6 offset-3">
                <h1 class="text-center mb-5 text-primary">Profile</h1>
                <h3 class="text-secondary">Photo</h3>
                @if ($photo)
                    <img src="{{ asset('storage/images/' . $photo->path) }}" alt="Profile Photo" class="rounded img-fluid"
                        width="70"height="70">
                        @php
                            $photoroute = "profile.updatePhoto";
                        @endphp
                        @else
                        @php
                            $photoroute = 'profile.storePhoto';
                        @endphp
                @endif
                <form action="{{ route($photoroute) }}" method="POST" enctype="multipart/form-data">
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
                @if ($address)
                    @php
                        $addressroute = "profile.updateAddress";
                    @endphp
                @else
                    @php
                        $addressroute = "profile.storeAddress";
                    @endphp
                @endif
                <form method="post" action="{{ route($addressroute) }}">
                    @csrf
                    <div class="form-group">
                        <label for="street">Street</label>
                        <input type="text" class="form-control" id="street" name="street"
                            value="{{ old('street', optional($address)->street) }}" required>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city"
                                value="{{ old('city', optional($address)->city) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="state">State</label>
                            <input type="text" class="form-control" id="state" name="state"
                                value="{{ old('state', optional($address)->state) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="zip_code">Zip Code</label>
                            <input type="text" class="form-control" id="zip_code" name="zip_code"
                                value="{{ old('zip_code', optional($address)->zip_code) }}" required>
                        </div>
                        <div class="form-group mt-5">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                </form>
                @include('partials.errors')
            </div>
        </div>
    </div>
@endsection
