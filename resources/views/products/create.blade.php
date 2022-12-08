@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create a new Product</div>
                <div class="card-body">
                    <form action="{{url('/products')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        Name: <input type="text" name="name" value="{{old('name')}}"><br>
                        type: <input type="text" name="type" value="{{old('type')}}"><br>
                        Category: <input type="text" name="category" value="{{old('category')}}"><br>
                        Price: <input type="number" step="0.01" name="price" value="{{old('price')}}"><br>
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
