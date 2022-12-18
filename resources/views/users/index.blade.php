@extends('layouts.app')

@section('content')

@include('partials.success')

<ul class="list-group">
    @forelse($users as $user)
    <li class="list-group-item">
        <h5>{{$user->id}} - {{$user->name}} - {{$user->email}}</h5>
        <form action=" {{ route('users.destroy', compact('user')) }} " method="POST">
            @csrf
            <a class="btn btn-info" href="{{ route('users.show', compact('user')) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('users.edit', compact('user')) }}">Edit</a>
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </li>
    @empty
    <h5 class="text-center">No Users Found!</h5>
    @endforelse
</ul>
{{ $users->links('pagination::bootstrap-5') }}
@endsection
