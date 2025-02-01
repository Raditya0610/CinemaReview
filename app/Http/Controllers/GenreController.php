<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class GenreController extends Controller
{
    public function index()
    {
        $genres = DB::table('genres')->get();
        return view('genres.index', ['genres' => $genres]);
    }

    public function create()
    {
        return view('genres.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        DB::table('genres')->insert([
            'name' => $request->input('name'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect('/genre');
    }

    public function show($id)
    {
        $genre = DB::table('genres')->where('id', $id)->first();
        if (!$genre) {
            abort(404, 'Genre not found');
        }

        $films = DB::table('films')->where('genre_id', $id)->get();

        return view('genres.show', ['genre' => $genre, 'films' => $films]);
    }

    public function edit($id)
    {
        $genre = DB::table('genres')->where('id', $id)->first();
        if (!$genre) {
            abort(404, 'Genre not found');
        }

        return view('genres.edit', ['genre' => $genre]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        DB::table('genres')->where('id', $id)->update([
            'name' => $request->input('name'),
            'updated_at' => Carbon::now(),
        ]);

        return redirect('/genre');
    }

    public function destroy($id)
    {
        DB::table('genres')->where('id', $id)->delete();
        return redirect('/genre');
    }
}
