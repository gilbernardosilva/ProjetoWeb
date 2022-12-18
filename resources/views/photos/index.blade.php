@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Photos</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Path</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($photos as $photo)
                    <tr>
                        <td>{{ $photo->id }}</td>
                        <td>{{ $photo->name }}</td>
                        <td>{{ $photo->path }}</td>
                        <td>
                            <form action=" {{ route('photo.destroy', compact('photo')) }} " method="POST">
                                @csrf
                                <a class="btn btn-info" href="{{ route('photo.show', compact('photo')) }}">Show</a>
                                <a class="btn btn-primary" href="{{ route('photo.edit', compact('photo')) }}">Edit</a>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection


