<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FilteredMovieController extends Controller
{
    public function filterMovie(Request $request)
    {
        $director = $request['director'];
        $genre = $request['genre'];
        $composer = $request['composer'];
        $date1 = $request['date1'];

        if(empty($request['date2'])){
            $date2 = '2020';
        } else {
            $date2 = $request['date2'];
        }


        $filteredMovies = DB::table('movies as m')->select(
            DB::raw('m.*, 
                    GROUP_CONCAT(DISTINCT g.genre) AS genros,
                    GROUP_CONCAT(DISTINCT d.director) AS director,
                    GROUP_CONCAT(DISTINCT c.composer) AS composer
                    ')
        )->
        leftJoin('movie_genre_ids as m_g_i', 'm_g_i.movie_id', '=', 'm.id')->
        leftJoin('movie_director_ids as m_d_i', 'm_d_i.movie_id', '=', 'm.id')->
        leftJoin('movie_composer_ids as m_c_i', 'm_c_i.movie_id', '=', 'm.id')->
        leftJoin('genres as g', 'm_g_i.genre_id', '=', 'g.id')->
        leftJoin('directors as d', 'm_d_i.director_id', '=', 'd.id')->
        leftJoin('composers as c', 'm_c_i.composer_id', '=', 'c.id')->
        groupBy('m.id')->
        when($director, function($query) use ($director) {return $query->where('d.director', '=', $director);})->
        when($genre, function($query) use ($genre) {return $query->where('g.genre', '=', $genre);})->
        when($composer, function($query) use ($composer) {return $query->where('c.composer', '=', $composer);})->
        when($date1, function($query) use ($date1, $date2) {return $query->whereBetween('m.year', [$date1, $date2]);})->
        get();

        return view('filteredPage', ["filteredMovies" => $filteredMovies]);

    }
}
