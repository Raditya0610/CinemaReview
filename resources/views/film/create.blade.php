@extends('layout.master')
@section('title')
    Tambah Film
@endsection

@section('content')
    <form action="/film" method="POST">
        @csrf
        <div class="form-group">
            <label>Judul Film</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>
        <div class="form-group">
            <label>Genre</label>
            <select name="genre_id" class="form-control">
                @foreach ($genres as $genre)
                <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
        </div>
        <div class="form-group">
            <label>Tahun Rilis</label>
            <input type="number" name="releaseYear" class="form-control" value="{{ old('releaseYear') }}" required>
        </div>
        <div class="form-group">
            <label>Cast</label>
            <input type="text" name="cast" class="form-control" value="{{ old('cast') }}" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
@endsection