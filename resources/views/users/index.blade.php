@extends('layouts.app')

@section('content')
    <div class="container">
        <a class="btn btn-secondary float-right" href="{{ route('users.create') }}">Add</a>
        <h1>Users</h1>
        <table class="table table-bordered striped ">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Social ID</th>
                    <th>SocialType</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>{{ $user->social_id }}</td>
                        <td>{{ $user->social_type }}</td>
                        <td>
                            <form action=" {{ route('users.destroy', compact('user')) }} " method="POST">
                                @csrf
                                <a class="btn btn-info" href="{{ route('users.show', compact('user')) }}">Show</a>
                                <a class="btn btn-primary" href="{{ route('users.edit', compact('user')) }}">Edit</a>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links('pagination::bootstrap-5') }}
    </div>
@endsection
