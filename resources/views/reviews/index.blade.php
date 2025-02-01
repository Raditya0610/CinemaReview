@extends('layout.master')
@section('title')
   Review
@endsection

@section('content')
<h2>{{$film_title}} Reviews</h2>
<a href="{{ url("/films/$film_id/reviews/create") }}" class="btn btn-primary mb-2">Add Review</a>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>User</th>
            <th>Content</th>
            <th>Rating</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reviews as $index => $review)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $review->username }}</td>
                <td>{{ $review->content }}</td>
                <td>{{ $review->rating }}/5</td>
                <td>
                    @if(Auth::id() == $review->user_id)
                        <a href="{{ url("/reviews/$review->id/edit") }}" class="btn btn-warning">Edit</a>
                        <form action="{{ url("/reviews/$review->id") }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    @endif
                    <a href="{{ url("/reviews/$review->id") }}" class="btn btn-info">View</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection