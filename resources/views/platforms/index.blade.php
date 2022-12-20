@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-5 text-danger">Platform Index</h1>
        <a class="btn btn-secondary float-right" href="{{ route('platforms.create')}}">Add</a>
        <h2 class="text-secondary">Platforms</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($platforms as $platform)
                    <tr>
                        <td>{{ $platform->id }}</td>
                        <td>{{ $platform->name }}</td>
                        <td>
                            <form action=" {{ route('platforms.destroy', compact('platform')) }} " method="POST">
                                @csrf
                                <a class="btn btn-info" href="{{ route('platforms.show', compact('platform')) }}">Show</a>
                                <a class="btn btn-primary" href="{{ route('platforms.edit', compact('platform')) }}">Edit</a>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $platforms->links('pagination::bootstrap-5') }}
    </div>
@endsection


