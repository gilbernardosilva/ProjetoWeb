@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add a new Game</div>
                    <div class="card-body">
                        <form action="{{ url('/games') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label for="gameName">Game Title:</label><br>
                            <input type="text" id="gameName" name="gameName" value="{{ old('gameName') }}"><br>
                            <br>
                            <label for="category">Category:</label><br>
                            {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
                            <br>
                            <label for="description">Description:</label><br>
                            <textarea id="description" name="description" rows="5" cols="50" value="{{ old('description') }}"></textarea><br>
                            <br>
                            <label for="thumbnail">Thumbnail:</label><br>
                            <input type="file" id="thumbnail" name="thumbnail"><br>
                            <br>
                            <label for="image1">Image 1:</label><br>
                            <input type="file" id="image1" name="image1"><br>
                            <br>
                            <label for="image2">Image 2:</label><br>
                            <input type="file" id="image2" name="image2"><br>
                            <br>
                            <label for="image3">Image 3:</label><br>
                            <input type="file" id="image3" name="image3"><br>
                            <br>
                            <input type="submit" value="Submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
