@extends('layouts.app')

@section('content')
    <div class="container">
        <a class="btn btn-secondary float-right" href="{{ route('products.create')}}">Add</a>
        <h1>Products</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Game</th>
                    <th>UserID</th>
                    <th>Platform</th>
                    <th>Price</th>
                    <th>Discount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->game->name }}</td>
                        <td>{{ $product->user->id }}</td>
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


