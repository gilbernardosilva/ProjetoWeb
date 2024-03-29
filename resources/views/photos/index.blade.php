@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-5 text-danger">Photos Index</h1>
        <a class="btn btn-secondary float-right" href="{{ route('photos.create')}}">Add</a>
        <h2 class="text-secondary">Photos</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Path</th>
                    <th>UserID</th>
                    <th>GameID</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($photos as $photo)
                    <tr>
                        <td>{{ $photo->id }}</td>
                        <td>{{ $photo->name }}</td>
                        <td>{{ $photo->path }}</td>
                        <td>{{ $photo->user_id }}</td>
                        <td>{{ $photo->game_id }}</td>
                        <td>
                            <form action=" {{ route('photos.destroy', compact('photo')) }} " method="POST">
                                @csrf
                                <a class="btn btn-info" href="{{ route('photos.show', compact('photo')) }}">Show</a>
                                <a class="btn btn-primary" href="{{ route('photos.edit', compact('photo')) }}">Edit</a>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $photos->links('pagination::bootstrap-5') }}
    </div>
@endsection


