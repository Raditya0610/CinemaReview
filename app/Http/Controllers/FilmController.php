<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FilmController extends Controller
{
    public function create()
    {
        $genres = DB::table('genres')->get(); 
        return view('film.create', ['genres' => $genres]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'genre_id' => 'required|exists:genres,id',
            'releaseYear' => 'required|integer',
            'description' => 'nullable|string',
            'cast' => 'required|string'
        ]);

        DB::table('films')->insert([
            'title' => $request->input('title'),
            'genre_id' => $request->input('genre_id'),
            'releaseYear' => $request->input('releaseYear'),
            'description' => $request->input('description'),
            'cast' => $request->input('cast'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect('/film');
    }

    public function index()
    {
        $films = DB::table('films')
            ->join('genres', 'films.genre_id', '=', 'genres.id')
            ->select('films.*', 'genres.name as genre_name')
            ->get();

        return view('film.index', ['films' => $films]);
    }

    public function show($id)
{
    $film = DB::table('films')
        ->join('genres', 'films.genre_id', '=', 'genres.id')
        ->select('films.*', 'genres.name as genre_name')
        ->where('films.id', $id)
        ->first();

    if (!$film) {
        abort(404, 'Film not found');
    }

    $reviews = DB::table('reviews')
        ->join('users', 'reviews.user_id', '=', 'users.id')
        ->where('film_id', $id)
        ->select('reviews.*', 'users.name as username')
        ->get();

    return view('film.show', [
        'film' => $film,
        'reviews' => $reviews,
    ]);
}

    public function edit($id)
    {
        $film = DB::table('films')->where('id', $id)->first();
        $genres = DB::table('genres')->get();

        if (!$film) {
            abort(404, 'Film not found');
        }

        return view('film.edit', ['film'=>$film, 'genres'=>$genres]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'genre_id' => 'required|exists:genres,id',
            'description' => 'required|string',
            'releaseYear' => 'required|integer',
            'cast' => 'required|string',
        ]);
    
        DB::table('films')->where('id', $id)->update([
            'title' => $request->input('title'),
            'genre_id' => $request->input('genre_id'),
            'description' => $request->input('description'),
            'releaseYear' => $request->input('releaseYear'),
            'cast' => $request->input('cast'),
            'updated_at' => now(),
        ]);
        return redirect('/film');
    }

    public function destroy($id)
    {
        DB::table('films')->where('id', $id)->delete();
        return redirect('/film');
    }
}