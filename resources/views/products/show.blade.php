@extends('layouts.app')

@section('content')
    <h1>{{ $product->game->name }}</h1>
    <p>{{ $product->game->category->name }}</p>
    <p>Price: {{ $product->price }}</p>
@endsection
