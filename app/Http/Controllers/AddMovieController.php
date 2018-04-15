<?php

namespace App\Http\Controllers;


use App\Movie;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class AddMovieController extends Controller
{
    public function addMoviePage()
    {
        return view('addMovie');
    }

    public function addMovie(Request $request)
    {

        $this->validate($request, [
            'movie_name' => 'required|max:30',
            'country' => 'max:30',
            'year' => 'max:30',
            'budget' => 'max:30',
            'duration' => 'max:30',
            'img' => 'mimes:jpeg, jpg, png',
            'genre' => 'max:50'
        ]);

        $mName = strToLower(trim(($request['movie_name'])));
        $country = strToLower(trim(($request['country'])));
        $year = strToLower(trim(($request['year'])));
        $budget = strToLower(trim(($request['budget'])));
        $duration = strToLower(trim(($request['duration'])));
        $gName = strToLower(trim(($request['genre'])));
        $dName = strToLower(trim($request['director']));
        $cName = strToLower(trim($request['composer']));
        $aName = strToLower(trim($request['art_director']));
        $oName = strToLower(trim($request['operator']));
        $pName = strToLower(trim($request['producer']));
        $sName = strToLower(trim($request['scenarist']));
        $eName = strToLower(trim($request['scenarist']));

        $movie = new Movie();
        if (!empty($request['img'])) {
            $poster_name = $_FILES['img']['name'];
            $request->file('img')->storeAs('posters', $poster_name);
            $movie->poster = $poster_name;
        }
        $movie->movie_name = $mName;
        $movie->year = $year;
        $movie->country = $country;
        $movie->budget = $budget;
        $movie->duration = $duration;

        $movie_id = [];

        if ($movie->save()) {
            $msg = 'New movie has been successfully created';
            $movie_id[] = $movie->id;
            $movie_ids = implode('', $movie_id);
            $this->universal_inserter($gName, 'genre', 'genres', 'movie_genre_ids', 'movie_id', 'genre_id', $movie_ids);
            $this->universal_inserter($dName, 'director', 'directors', 'movie_director_ids', 'movie_id', 'director_id', $movie_ids);
            $this->universal_inserter($cName, 'composer', 'composers', 'movie_composer_ids', 'movie_id', 'composer_id', $movie_ids);
            $this->universal_inserter($aName, 'art_director', 'art_directors', 'movie_artdir_ids', 'movie_id', 'artdir_id', $movie_ids);
            $this->universal_inserter($oName, 'operator', 'operators', 'movie_operator_ids', 'movie_id', 'operator_id', $movie_ids);
            $this->universal_inserter($pName, 'producer', 'producers', 'movie_producer_ids', 'movie_id', 'producer_id', $movie_ids);
            $this->universal_inserter($sName, 'scenarist', 'scenarists', 'movie_scenarist_ids', 'movie_id', 'scenarist_id', $movie_ids);
            $this->universal_inserter($eName, 'editor', 'editors', 'movie_editor_ids', 'movie_id', 'editor_id', $movie_ids);
        } else {
            $msg = 'Error occurred';
        }
        return redirect(route('add_movie_page'))->with(['message' => $msg]);
    }

    private function universal_inserter($input_val, $column_val, $main_table, $connector_table, $conn_table_column1, $conn_table_column2, $movie_ids)
    {
        $universal_id_arr = [];
        $arr = explode(',', $input_val);
        foreach ($arr as $value) {
            $columnValueExists = DB::table($main_table)->where($column_val, $value)->get();
            if (count($columnValueExists) > 0) {

            } else {
                DB::table($main_table)->insert([$column_val => $value]);
            }
            $input_val_ids = DB::table($main_table)->select('id')->where($column_val, $value)->get();
            foreach ($input_val_ids as $ids) {
                $universal_id_arr[] = $ids->id;
            }
        }
        foreach ($universal_id_arr as $val) {
            DB::table($connector_table)->insert([$conn_table_column1 => $movie_ids, $conn_table_column2 => $val]);
        }
    }
}
