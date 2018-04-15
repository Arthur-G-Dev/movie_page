<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AllMoviesController extends Controller
{
    public function getAllMovies()
    {
        $movies = DB::table('movies')->select('id','movie_name','poster')->get();

        return view('allMovies', ['movies' => $movies]);
    }
}
