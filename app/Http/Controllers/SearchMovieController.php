<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;

class SearchMovieController extends Controller
{
    public function searchMovie(Request $request){
        $movie = $request['search'];
        $movies = Movie::select('id', 'movie_name', 'poster')->where('movie_name', 'like', '%'.$movie.'%')->get();

        return view('searchedMovie', ['movies' => $movies]);
    }
}
