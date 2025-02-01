@extends('layout.master')
@section('title')
    Edit Film
@endsection

@section('content')
    <form action="/film/{{$film->id }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Judul Film</label>
            <input type="text" name="title" class="form-control" value="{{ $film->title }}" required>
        </div>
        <div class="form-group">
            <label>Genre</label>
            <select name="genre_id" class="form-control">
                @foreach ($genres as $genre)
                <option value="{{ $genre->id }}" {{ $genre->id == $film->genre_id ? 'selected' : '' }}>{{ $genre->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control">{{ $film->description }}</textarea>
        </div>
        <div class="form-group">
            <label>Tahun Rilis</label>
            <input type="number" name="releaseYear" class="form-control" value="{{ $film->releaseYear }}" required>
        </div>
        <div class="form-group">
            <label>Cast</label>
            <input type="text" name="cast" class="form-control" value="{{ $film->cast }}" required>
        </div>
        <button type="submit" class="btn btn-warning">Update</button>
    </form>
</div>
@endsection