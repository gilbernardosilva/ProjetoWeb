@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add a new product</div>
                    <div class="card-body">
                        <form action="{{ url('/games') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label for="gameName">Game Title:</label><br>
                            {!! Form::select('game_id', $games, null, ['class' => 'form-control']) !!}
                            <br>
                            <label for="category">Category:</label><br>
                            {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
                            <br>
                            <label for="platform">Platform:</label><br>
                            {!! Form::select('platform_id', $platforms, null, ['class' => 'form-control']) !!}
                            <br>
                            <label for="price">Price:</label>
                            <input type="number" id="price" name="price" step="0.01" min="0" max="1000">
                            <br>
                            <input type="submit" value="Submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
