@extends('layout.master')
@section('title')
    Daftar Film
@endsection

@section('content')
<h2>Review Details</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Reviewed by: {{ $review->username }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">Rating: {{ $review->rating }}/5</h6>
            <p class="card-text">{{ $review->content }}</p>
            <p class="text-muted">Reviewed on: {{ $review->created_at }}</p>
        </div>
    </div>

    <a href="{{ url("/films/$review->film_id/reviews") }}" class="btn btn-secondary mt-3">Back to Reviews</a>

    @if(Auth::id() == $review->user_id)
        <a href="{{ url("/reviews/$review->id/edit") }}" class="btn btn-warning mt-3">Edit</a>
        <form action="{{ url("/reviews/$review->id") }}" method="POST" style="display:inline;">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-danger mt-3">Delete</button>
        </form>
    @endif
@endsection