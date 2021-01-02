<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use \App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use app\models\Post;
use app\models\User;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function apiindex(Request $request, $post)
    {
        $comments = Comment::where('post_id',$post)->with('user')->latest()->get();
        return $comments;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function apistore(Request $request)
    {
        $comment = new Comment;
        if ($request['comment'] == null){
            return 0;
        }
        if (strlen($request['comment'])>100){
            return 1;
        }
        $comment->content= $request['comment'];
        $comment->user_id = $request['user'];
        $comment->post_id = $request['post'];
        $comment->save();
        return $comment->with('user')->get();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {    
        $comment = Comment::find($id);
        $comment->delete();
        return $id;
    }
}