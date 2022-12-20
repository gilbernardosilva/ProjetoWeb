@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-5 text-danger">Categories Index</h1>
        <a class="btn btn-secondary float-right" href="{{ route('categories.create')}}">Add</a>
        <h2 class="text-secondary">Categories</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <form action=" {{ route('categories.destroy', compact('category')) }} " method="POST">
                                @csrf
                                <a class="btn btn-info" href="{{ route('categories.show', compact('category')) }}">Show</a>
                                <a class="btn btn-primary" href="{{ route('categories.edit', compact('category')) }}">Edit</a>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $categories->links('pagination::bootstrap-5') }}
    </div>
@endsection


