@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-5 text-danger">Products Index</h1>
        <a class="btn btn-secondary float-right" href="{{ route('products.create')}}">Add</a>
        <h2 class="text-secondary">Products</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Game</th>
                    <th>UserID</th>
                    <th>Platform</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->game->name }}</td>
                        @if($product->user)
                        <td>{{ $product->user->id }}</td>
                        @else
                        <td></td>
                        @endif
                        <td>{{ $product->platform->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->discount }}</td>
                        <td>
                            <form action=" {{ route('products.destroy', compact('product')) }} " method="POST">
                                @csrf
                                <a class="btn btn-info" href="{{ route('products.show', compact('product')) }}">Show</a>
                                <a class="btn btn-primary" href="{{ route('products.edit', compact('product')) }}">Edit</a>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
@endsection


