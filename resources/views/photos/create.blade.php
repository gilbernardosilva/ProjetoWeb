@extends('layouts.app')
@section('content')
    <div class="row mb-5">
        <div class="col-6 offset-3">
            <h1 class="text-center mb-5 text-primary">Photo Create</h1>
            <label for="type">Type:</label>
            <select name="type" id="type" onchange="updateType()" class="form-select">
                <option value="Select">Select</option>
                <option value="user">User</option>
                <option value="game">Game</option>
                <option value="default">Default</option>
            </select>
            <div id="form-container">
            </div>
            @include('partials.errors')
        </div>
    </div>
    <script>
        function updateType() {
            var type = document.getElementById('type').value;
            var formContainer = document.getElementById('form-container');

            if (type == 'user') {
                formContainer.innerHTML = `@include('photos.create-user')`;
            } else if (type == 'game') {
                formContainer.innerHTML = `@include('photos.create-game')`;
            } else {
                formContainer.innerHTML = `@include('photos.create-default')`;
            }
        }
    </script>
@endsection
