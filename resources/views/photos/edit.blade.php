@extends('layouts.app')

@section('content')
<h3 class="text-secondary">Photo</h3>
        <img src="{{ asset('storage/images/' . $photo->path) }}" alt="Profile Photo" class="rounded img-fluid" width="160"height="90">

        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="inputImage"></label>
                <input type="file" name="image" id="inputImage"
                    class="form-control">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Upload</button>
            </div>
</form>
@endsection
