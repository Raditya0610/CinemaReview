@extends('layout.master')
@section('title')
    Show Film
@endsection

@section('content')
<div class="container mt-4">
    <h2>{{ $film->title }}</h2>
    <p><strong>Genre:</strong> {{ $film->genre_name }}</p>
    <p><strong>Release Year:</strong> {{ $film->releaseYear }}</p>
    <p><strong>Description:</strong> {{ $film->description }}</p>

    <h4>Reviews</h4>
    @if ($reviews->isEmpty())
        <p>No reviews yet. Be the first to review!</p>
    @else
        @foreach ($reviews as $review)
            <div class="mb-3">
                <p><strong>{{ $review->username }}</strong> rated {{ $review->rating }}/5</p>
                <p>{{ $review->content }}</p>
                <hr>
            </div>
        @endforeach
    @endif

    <h4>Add Your Review</h4>
    <form action="/films/{{$film->id}}/reviews" method="POST">
        @csrf
        <div class="form-group">
            <label for="content">Review</label>
            <textarea name="content" id="content" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="rating">Rating</label>
            <input type="number" name="rating" id="rating" class="form-control" min="1" max="5" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection