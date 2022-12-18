@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-md-6 mx-auto">
            <header>
                <h1>Admin Panel</h1>
            </header>
        </div>
        <div class="col-md-6 mx-auto">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="/dashboard">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="/user">Users</a></li>
                    <li class="nav-item"><a class="nav-link" href="/photo">Photos</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Categories</a></li>
                </ul>
            </nav>
        </div>
    </div>
@endsection
