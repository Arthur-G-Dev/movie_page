<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AllMoviesController extends Controller
{
    public function getAllMovies(){
        $movies = DB::table('movies as m')->select(DB::raw('m.*, GROUP_CONCAT(DISTINCT g.genre) AS genros'))->leftJoin('movie_genre_ids as m_g_i', 'm_g_i.movie_id', '=', 'm.id')->leftJoin('genres as g', 'm_g_i.genre_id', '=', 'g.id')->groupBy('m.id')->get();

        return view('allMovies', ['movies' => $movies]);
    }
}
