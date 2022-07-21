@extends('layouts.backend', compact('title'))

@section('content')
    <div class="card">
        <div class="card-header">{{ $title }}</div>
        <div class="card-body">
            <form action="{{ route('genres.edit', $genre) }}" method="post">
                @csrf
                @method('put')

                <label for="name" class="form-label">Name</label>
                <input type="text" value="{{ old('name') ?? $genre->name}}" name="name" id="name" class="form-control @error('name') is-invalid @enderror">
                @error('name')
                    <span class="invalid-feedback"> {{ $message }}</span>
                @enderror

                <button type="submit" class="btn btn-primary mt-3">Update</button>
            </form>
        </div>
    </div>
@endsection