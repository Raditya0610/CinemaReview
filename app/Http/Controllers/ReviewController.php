<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class ReviewController extends Controller
{
    public function index($film_id) {
        $film = DB::table('films')->where('id', $film_id)->first();

        if (!$film) {
            abort(404, 'Film not found');
        }
    
        $reviews = DB::table('reviews')
            ->join('users', 'reviews.user_id', '=', 'users.id')
            ->where('film_id', $film_id)
            ->select('reviews.*', 'users.name as username')
            ->get();
    
        return view('reviews.index', [
            'film_id' => $film_id,
            'film_title' => $film->title,  
            'reviews' => $reviews
        ]);
    }

    public function show($id) {
        $review = DB::table('reviews')
            ->where('reviews.id', $id)
            ->join('users', 'reviews.user_id', '=', 'users.id')
            ->select('reviews.*', 'users.name as username')
            ->first();

        if (!$review) {
            abort(404, 'Review not found');
        }

        return view('reviews.show', compact('review'));
    }

    public function create($film_id) {
        return view('reviews.create', compact('film_id'));
    }

    public function store(Request $request, $film_id) {
        $request->validate([
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        DB::table('reviews')->insert([
            'film_id' => $film_id,
            'user_id' => Auth::id(),
            'content' => $request->input('content'),
            'rating' => $request->input('rating'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect("/films/$film_id/reviews")->with('success', 'Review added successfully!');
    }

    public function edit($id) {
        $review = DB::table('reviews')->where('id', $id)->first();

        if (!$review || $review->user_id != Auth::id()) {
            abort(403, 'Unauthorized action');
        }

        return view('reviews.edit', compact('review'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $review = DB::table('reviews')->where('id', $id)->first();

        if (!$review || $review->user_id != Auth::id()) {
            abort(403, 'Unauthorized action');
        }

        DB::table('reviews')->where('id', $id)->update([
            'content' => $request->input('content'),
            'rating' => $request->input('rating'),
            'updated_at' => now(),
        ]);

        return redirect("/reviews/$id")->with('success', 'Review updated successfully!');
    }

    public function destroy($id) {
        $review = DB::table('reviews')->where('id', $id)->first();

        if (!$review || $review->user_id != Auth::id()) {
            abort(403, 'Unauthorized action');
        }

        DB::table('reviews')->where('id', $id)->delete();

        return redirect("/films/{$review->film_id}/reviews")->with('success', 'Review deleted successfully!');
    }}
