@extends('layout.master')
@section('title')
    Daftar Film
@endsection

@section('content')
<div class="container mt-4">
    <h2>Daftar Film</h2>
    <a href="{{ url('/film/create') }}" class="btn btn-primary mb-2">Tambah Film</a>

    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Judul</th>
                <th>Description</th>
                <th>Genre</th>
                <th>Tahun Rilis</th>
                <th>Cast</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($films as $film)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $film->title }}</td>
                <td>{{ $film->description }}</td>
                <td>{{ $film->genre_name }}</td>
                <td>{{ $film->releaseYear }}</td>
                <td>{{$film->cast}}</td>
                <td>
                    <a href="/film/{{ $film->id }}" class="btn btn-info btn-sm">Detail</a>
                    <a href="/film/{{ $film->id }}/edit" class="btn btn-warning btn-sm">Edit</a>
                    <form action="/film/{{ $film->id }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection