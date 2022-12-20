@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-5 text-danger">Games Index</h1>
        <a class="btn btn-secondary float-right" href="{{ route('games.create')}}">Add</a>
        <h2 class="text-secondary">Games</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($games as $game)
                    <tr>
                        <td>{{ $game->id }}</td>
                        <td>{{ $game->name }}</td>
                        <td>{{ $game->description }}</td>
                        <td>{{ $game->category->name }}</td>
                        <td>
                            <form action=" {{ route('games.destroy', compact('game')) }} " method="POST">
                                @csrf
                                <a class="btn btn-info" href="{{ route('games.show', compact('game')) }}">Show</a>
                                <a class="btn btn-primary" href="{{ route('games.edit', compact('game')) }}">Edit</a>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $games->links('pagination::bootstrap-5') }}
    </div>
@endsection


