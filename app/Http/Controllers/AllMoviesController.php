<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class AllMoviesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAllMovies()
    {


        $val = Cache::remember('movies', 3, function(){
            $movies = DB::table('movies')->select('id','movie_name','poster')->paginate(2);
            return view('allMovies')->with(['movies' => $movies]);
        });
        dd($val);
        return  $val;
    }
}
