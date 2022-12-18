@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Users</h1>
        <table class="table table-bordered">
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
                            <form action=" {{ route('user.destroy', compact('user')) }} " method="POST">
                                @csrf
                                <a class="btn btn-info" href="{{ route('user.show', compact('user')) }}">Show</a>
                                <a class="btn btn-primary" href="{{ route('user.edit', compact('user')) }}">Edit</a>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
