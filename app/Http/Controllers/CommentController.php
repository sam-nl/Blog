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
        //return response()->json($post->comments()->with('user')->latest()->get());
        
        /*
        $comments = Comment::get();
        
        return $comments;
        */
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function apistore(Request $request)
    {
        /*
        $comment = $request->post->comments->create([
            'content' =>$request->content,
            'user_id'=> Auth::user(),
        ]);
        $comment = Comment::where('id',$comment->id)->with('user')->first();
        return $comment;
        */
       $comment = new Comment;
       $comment->content= $request['comment'];
       $comment->user_id = $request['user'];
       $comment->post_id = $request['post'];
        $comment->save();
        return $comment->with('user')->get();
        


    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
