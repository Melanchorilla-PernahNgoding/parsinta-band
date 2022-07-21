<div class="form-group">
    <label for="name">Thumbnail</label>
    <input type="file" name="thumbnail" id="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror">
    @error('thumbnail')
        <span class="mt-2 text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') ?? $band->name }}">
    @error('name')
        <span class="mt-2 text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <label for="genres">Choose Genres</label>
    <select type="text" name="genres[]" id="genres" class="form-control select2multiple @error('genres') is-invalid @enderror" multiple>
        @foreach($genres as $genre)
            <option {{ $band->genres()->find($genre->id) ? 'selected' : '' }} value="{{ $genre->id }}">{{ $genre->name }}</option>
        @endforeach
    </select>
    @error('genres')
        <span class="mt-2 text-danger">{{ $message }}</span>
    @enderror
</div>

<button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>
