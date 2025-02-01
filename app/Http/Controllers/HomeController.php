<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $films = DB::table('films')
        ->join('genres', 'films.genre_id', '=', 'genres.id')
        ->select('films.*', 'genres.name as genre_name')
        ->get();
        return view('film.index',compact('films'));
    }
}
