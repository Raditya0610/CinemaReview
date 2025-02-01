@extends('layout.master')
@section('title')
    Daftar Film
@endsection

@section('content')
<h2>Edit Review</h2>
<form action="{{ url("/reviews/$review->id") }}" method="POST">
    @csrf @method('PUT')
    <div class="form-group">
        <label>Review Content</label>
        <textarea name="content" class="form-control">{{ $review->content }}</textarea>
    </div>
    <div class="form-group">
        <label>Rating</label>
        <select name="rating" class="form-control">
            <option value="1" {{ $review->rating == 1 ? 'selected' : '' }}>1 - Poor</option>
            <option value="2" {{ $review->rating == 2 ? 'selected' : '' }}>2 - Fair</option>
            <option value="3" {{ $review->rating == 3 ? 'selected' : '' }}>3 - Good</option>
            <option value="4" {{ $review->rating == 4 ? 'selected' : '' }}>4 - Very Good</option>
            <option value="5" {{ $review->rating == 5 ? 'selected' : '' }}>5 - Excellent</option>
        </select>
    </div>
    <button type="submit" class="btn btn-warning">Update Review</button>
</form>
@endsection