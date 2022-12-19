@extends('layouts.app')
@section('content')
<form method="post" action="{{ route('products.store') }}">
    @csrf
    <select name="user_id" id="user_id" class="form-select">
        @foreach($games as $game)
          <option value="{{ $game->id }}">{{ $game->name }}</option>
        @endforeach
    </select>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <div class="form-group">
        <label for="password-confirm">Confirm Password</label>
        <input type="password" class="form-control" id="password-confirm" name="password_confirmation"  required>
    </div>
    <div class="form-group mt-5">
        <button type="submit" class="btn btn-primary">Create</button>
    </div>
</form>
@include('partials.errors')
@endsection
