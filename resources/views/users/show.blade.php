@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <div class="row mb-5">
            <div class="col-6 offset-3">
                <h1 class="text-center mb-5 text-danger">User Show</h1>
                <h2 class="text-secondary text-center">User Info</h2>
                    <form>
                        <div class="form-group">
                            <label for="name">ID</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name', $user->id) }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="email">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name', $user->name) }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="name">Email</label>
                            <input type="text" class="form-control text-cent" id="name" name="name"
                                value="{{ old('name', $user->email) }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="email">Role</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name', $user->role) }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="name">SocialID</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name', $user->social_id) }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="email">Social Type</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name', $user->social_type) }}" disabled>
                        </div>
                        <div class="form-group">
                            <a class="btn btn-success" href="/users">Go Back</a>
                        </div>
                    </form>
            </div>
        </div>
    </div>
@endsection
