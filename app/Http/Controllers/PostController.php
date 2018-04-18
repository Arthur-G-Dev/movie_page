<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Comment;
use App\User;

class PostController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postCreatePost(Request $request)
    {
        $post = new Post();
        $post->body = $request->get('body');
        $post->user_id = Auth::user()->id;
        $post->movie_id = $request['movieId'];
        $post->save();

        return response()->json(['body' => $post->body]);
    }

    /**
     * @param $movie_id
     * @return mixed
     */
    public static function getAllPosts($movie_id)
    {
        $movie_id = htmlspecialchars_decode(trim($movie_id));
        $posts = Post::where('movie_id', '=', $movie_id)->orderBy('created_at', 'desc')->get();

        return $posts;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addComment(Request $request)
    {

        $comment = $request['body'];
        $post_id = $request['postId'];

        $comments = new Comment();
        $comments->comment = $comment;
        $comments->post_id = $post_id;
        $comments->user_id = Auth::user()->id;
        $comments->save();


        return response()->json(['res' => $comments->comment]);
    }

    /**
     * @return mixed
     * getting all comments from Db
     */
    public function getComments()
    {
        $comments = Comment::orderBy('created_at', 'desc')->get();
        return $comments;
    }


}
