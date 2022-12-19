@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row mb-5">
            <div class="col-6 offset-3">
                <div class="form-group">
                    <h3 class="text-secondary text-center">Photo Info</h3>
                    <form action="{{ route('photos.update', compact('photo')) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <img src="{{ asset('storage/images/' . $photo->path) }}" alt="Profile Photo"
                                class="rounded img-fluid mx-auto d-block" width="160"height="90">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="inputImage"></label>
                            <input type="file" name="image" id="inputImage" class="form-control">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

        @endsection
