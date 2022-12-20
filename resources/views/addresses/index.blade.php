@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-5 text-danger">Addresses Index</h1>
        <a class="btn btn-secondary float-right" href="{{ route('addresses.create')}}">Add</a>
        <h2 class="text-secondary">Addresses</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Street</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Zip-Code</th>
                    <th>UserID</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($addresses as $address)
                    <tr>
                        <td>{{ $address->id }}</td>
                        <td>{{ $address->street }}</td>
                        <td>{{ $address->city }}</td>
                        <td>{{ $address->state }}</td>
                        <td>{{ $address->zip_code }}</td>
                        @if($address->user)
                        <td>{{ $address->user->id }}</td>
                        @else
                        <td></td>
                        @endif
                        <td>
                            <form action=" {{ route('addresses.destroy', compact('address')) }} " method="POST">
                                @csrf
                                <a class="btn btn-info" href="{{ route('addresses.show', compact('address')) }}">Show</a>
                                <a class="btn btn-primary" href="{{ route('addresses.edit', compact('address')) }}">Edit</a>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $addresses->links('pagination::bootstrap-5') }}
    </div>
@endsection


