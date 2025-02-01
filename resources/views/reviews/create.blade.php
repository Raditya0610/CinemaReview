@extends('layout.master')
@section('title')
    Daftar Film
@endsection

@section('content')
<h2>Add Review</h2>
    <form action="{{ url("/films/$film_id/reviews") }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Review Content</label>
            <textarea name="content" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label>Rating</label>
            <select name="rating" class="form-control">
                <option value="1">1 - Poor</option>
                <option value="2">2 - Fair</option>
                <option value="3">3 - Good</option>
                <option value="4">4 - Very Good</option>
                <option value="5">5 - Excellent</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit Review</button>
    </form>
@endsection