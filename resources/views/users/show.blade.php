@extends('layouts.app')

@section('content')
    <h1>{{ $user->name- }}</h1>
    <p>{{ $user->email}}</p>
    <p>{{ $user->photo }}</p>
@endsection
