<form method="POST" action="{{ route('photo.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="image">Image:</label>
      <input type="file" name="image" id="image" required class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>

