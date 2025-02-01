@extends('layout.master')
@section('title')
    Daftar Film
@endsection

@section('content')
<div class="container mt-4">
    <h2>Daftar Genre</h2>
    <a href="{{ url('/genre/create') }}" class="btn btn-primary mb-2">Tambah Genre</a>

    <ul class="list-group">
        @foreach ($genres as $genre)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <a href="/genre/ {{$genre->id }}">{{ $genre->name }}</a>
            <div>
                <a href="/genre/{{$genre->id }}/edit" class="btn btn-warning btn-sm">Edit</a>
                <form action="/genre/{{$genre->id }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                </form>
            </div>
        </li>
        @endforeach
    </ul>
</div>
@endsection