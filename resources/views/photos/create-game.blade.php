<form method="POST" action="{{ route('photo.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="game_id">Game:</label>
      <select class="form-select" name="game_id" id="game_id">
        @foreach($games as $game)
          <option value="{{ $game->id }}">{{ $game->name }}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group">
      <label for="thumbnail">Thumbnail:</label>
      <input type="file" class="form-control" name="thumbnail" id="thumbnail">
    </div>
    <div class="form-group">
      <label for="image1">Image 1:</label>
      <input type="file" class="form-control" name="image1" id="image1">
    </div>
    <div class="form-group">
      <label for="image2">Image 2:</label>
      <input type="file" class="form-control" name="image2" id="image2">
    </div>
    <div class="form-group">
      <label for="image3">Image 3:</label>
      <input type="file" class="form-control" name="image3" id="image3" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
