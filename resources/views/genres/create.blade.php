@extends('layout.master')
@section('title')
    Daftar Film
@endsection

@section('content')
<div class="container mt-4">
    <h2>Tambah Genre Baru</h2>

    <form action="{{ url('/genre') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nama Genre</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection