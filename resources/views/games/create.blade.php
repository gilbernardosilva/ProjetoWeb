@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add a new Game</div>
                <div class="card-body">
                    <form action="{{url('/games')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        Name: <input type="text" name="name" value="{{old('name')}}"><br>
                        Category: <input type="text" name="category" value="{{old('category')}}"><br>
                        Description: <input type="text" name="description" value="{{old('description')}}"><br>
                        <input type="file" name="image">
                        <input type="submit" value="Upload">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
