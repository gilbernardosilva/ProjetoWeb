@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Peido's Dashboard</div>
                <div class="card-body">
                    <form action="{{url('/users')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        User Name: <input type="text" name="name" value="{{old('name')}}">
                        First Name: <input type="text" name="firstName" value="{{old('firstName')}}">
                        Last Name: <input type="text" name="lastName" value="{{old('lastName')}}">
                        Email: <input type="text" name="email" value="{{old('email')}}">
                        address: <input type="text" name="address" value="{{old('address')}}">
                        password: <input type="text" name="password" value="{{old('password')}}">
                        <input type="file" name="image">
                        <input type="submit" value="Upload">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
