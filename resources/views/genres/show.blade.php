@extends('layout.master')
@section('title')
    Daftar Film
@endsection

@section('content')
<div class="container mt-4">
    <h2>{{ $genre->name }}</h2>

    <h4>Film dalam Genre Ini</h4>
    <ul class="list-group">
        @foreach ($films as $film)
        <li class="list-group-item">
            <a href="/film/{{ $film->id }}">{{ $film->title }}</a>
        </li>
        @endforeach
    </ul>
</div>
@endsection