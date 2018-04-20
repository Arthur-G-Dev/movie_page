<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Comment;
use App\User;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postCreatePost(Request $request)
    {
        $validate = Validator::make($request->all(), [ 'body' => 'required|min: 5']);

            if($validate->fails()){
                return response()->json(['errors' => $validate->errors()], 422);
            }

        $post = new Post();
        $post->body = $request->get('body');
        $post->user_id = Auth::user()->id;
        $post->movie_id = $request['movieId'];
        $post->save();

        return response()->json(['body' => $post->body, 'validate' => $validate],200);
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
        $validate = Validator::make($request->all(), [ 'comment' => 'required|min: 5']);
        if($validate->fails()){
            return response()->json(['errors' => $validate->errors()], 422);
        }

        $comment = $request['comment'];
        $post_id = $request['postId'];

        $comments = new Comment();
        $comments->comment = $comment;
        $comments->post_id = $post_id;
        $comments->user_id = Auth::user()->id;
        $comments->save();

        return response()->json(['res' => $comments->comment ],200);
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
