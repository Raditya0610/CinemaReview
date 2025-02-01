@extends('layout.master')
@section('title')
    Daftar Film
@endsection

@section('content')
<div class="container mt-4">
    <h2>Edit Genre</h2>

    <form action="/genre/{{ $genre->id }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Nama Genre</label>
            <input type="text" name="name" class="form-control" value="{{ $genre->name }}" required>
        </div>
        <button type="submit" class="btn btn-warning">Update</button>
    </form>
</div>
@endsection