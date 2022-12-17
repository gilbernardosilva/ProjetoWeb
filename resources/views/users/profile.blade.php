@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-5 text-primary">Profile</h1>
        @include('users.photo.edit')
        @include('users.edit')
        @include('users.addresses.edit')
    </div>
@endsection
