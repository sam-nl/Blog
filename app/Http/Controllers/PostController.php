<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use \App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use \App\Models\Image;
use \App\Models\User;
use \App\Models\Tag;

class PostController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        $user = Auth::user();
        return view("posts/create")->with(array('tags'=>$tags))->with(array('user'=>$user));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $content = $request->content;
        $tags = $request->tags;
        if ($content==null){
            return back()->withErrors([
                'content' => 'The post is empty!',
            ]);
        }
        if (strlen($content) >500){
            return back()->withErrors([
                'content' => 'Post must be less than 500 characters',
            ]);
        }   
        if ($tags!=null){
            if (sizeof($tags)>5){
                return back()->withErrors([
                    'tags' => 'Maximum of five tags!',
                ]);
            }
        }
        $post = Post::create(['content'=>$content, 'user_id' => Auth::id()]);
        if ($tags!=null){
            foreach($tags as $tag){
                DB::table('post_tag')->insert([
                    'post_id' => $post->id,
                    'tag_id' => $tag
                ]);
            }
        }
        if ($request->hasFile('image')) {
            $image = $request->image;
            $extension = $image->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            $request->image->move('images', $filename);
            $image = $post->image()->create(['filename'=>$filename]);
            $post->save();
        }
        return redirect('users/profile/'.Auth::user()->username);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $post = Post::find($id);
        $user = Auth::user();
        if ($user->id == $post->user_id){
            return view('posts/edit')->with(array('post'=>$post))->with(array('user'=>$user));
        }
        return redirect('home');
    }
    public function view($id)
    {
        $post = Post::find($id);
        $user = User::find($post->user_id);
        $tagids = DB::table('post_tag')->where('post_id', $post->id)->get('tag_id');
        $tags= [];
        foreach ($tagids as $tid){
            array_push($tags,Tag::find($tid->tag_id)); 
        }
        array_pop($tags);
        return view('posts/view')->with(array('post'=>$post))->with(array('user'=>$user))->with(array('tags'=>$tags));
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
        $content = $request->content;
        $post = Post::find($id);
        if ($content==null){
            return back()->withErrors([
                'content' => 'The post is empty!',
            ]);
        }
        if (strlen($content) >500){
            return back()->withErrors([
                'content' => 'Post must be less than 500 characters',
            ]);
        }   
        $post->content = $content;
        $post->save();
        return redirect('users/profile/'.Auth::user()->username);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if(strtolower($request->delete) == "delete"){
            $post = Post::find($id);
            Image::where('imageable_id',$post->id)->
                where('imageable_type', 'App\Models\Post')->delete();
            $post->delete();
            return redirect('users/profile/'.session('profile')['username']);
        }
        return back()->withErrors([
            'delete' => 'Type delete to confirm'
        ]);       
    }
}