<?php

namespace App\Http\Controllers;

use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SingleMovieController extends Controller
{
    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getMovie($id){
        $movie_id = $id;

        $movie = DB::table('movies as m')->
        select(
            DB::raw('m.*, 
                    GROUP_CONCAT(DISTINCT g.genre) AS genros,
                    GROUP_CONCAT(DISTINCT d.director) AS director,
                    GROUP_CONCAT(DISTINCT c.composer) AS composer,
                    GROUP_CONCAT(DISTINCT artdir.art_director) AS art_director,
                    GROUP_CONCAT(DISTINCT o.operator) AS operator,
                    GROUP_CONCAT(DISTINCT p.producer) AS producer,
                    GROUP_CONCAT(DISTINCT s.scenarist) AS scenarist,
                    GROUP_CONCAT(DISTINCT e.editor) AS editor')
        )->
        leftJoin('movie_genre_ids as m_g_i', 'm_g_i.movie_id', '=', 'm.id')->
        leftJoin('movie_director_ids as m_d_i', 'm_d_i.movie_id', '=', 'm.id')->
        leftJoin('movie_composer_ids as m_c_i', 'm_c_i.movie_id', '=', 'm.id')->
        leftJoin('movie_artdir_ids as m_a_i', 'm_a_i.movie_id', '=', 'm.id')->
        leftJoin('movie_operator_ids as m_o_i', 'm_o_i.movie_id', '=', 'm.id')->
        leftJoin('movie_producer_ids as m_p_i', 'm_p_i.movie_id', '=', 'm.id')->
        leftJoin('movie_scenarist_ids as m_s_i', 'm_s_i.movie_id', '=', 'm.id')->
        leftJoin('movie_editor_ids as m_e_i', 'm_e_i.movie_id', '=', 'm.id')->
        leftJoin('genres as g', 'm_g_i.genre_id', '=', 'g.id')->
        leftJoin('directors as d', 'm_d_i.director_id', '=', 'd.id')->
        leftJoin('composers as c', 'm_c_i.composer_id', '=', 'c.id')->
        leftJoin('art_directors as artdir', 'm_a_i.artdir_id', '=', 'artdir.id')->
        leftJoin('operators as o', 'm_o_i.operator_id', '=', 'o.id')->
        leftJoin('producers as p', 'm_p_i.producer_id', '=', 'p.id')->
        leftJoin('scenarists as s', 'm_s_i.scenarist_id', '=', 's.id')->
        leftJoin('editors as e', 'm_e_i.editor_id', '=', 'e.id')->
        groupBy('m.id')->
        where('m.id', '=', $movie_id)->
        get();

        $previous_url = url()->previous();
        $posts = PostController::getAllPosts($movie_id);

        $comments = new PostController;
        $comments = $comments->getComments();

         return view('singleMovie', [
             'movie' => $movie,
             'posts' => $posts,
             'comments' => $comments,
             'prev_url' => $previous_url
         ]);
    }
}
