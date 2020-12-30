<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use \App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        
        return view("posts/index", compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = \App\Models\Tag::all();
        return view("posts/create", compact('tags'));
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
        if (strlen($content) >200){
            return back()->withErrors([
                'content' => 'Post must be less than 200 characters',
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
        
        

        return redirect('users/profile/'.session('user')['username']);
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
        
        $post = \App\Models\Post::find($id);
        return view('posts/edit')->with(array('post'=>$post->content));
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
        $post = \App\Models\Post::find($id);
        if ($content==null){
            return back()->withErrors([
                'content' => 'The post is empty!',
            ]);
        }
        if (strlen($content) >200){
            return back()->withErrors([
                'content' => 'Post must be less than 200 characters',
            ]);
        }
        
        $post->content = $content;
        $post->save();
        return redirect('users/profile/'.session('user')['username']);
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
            $post = \App\Models\Post::find($id);
           \App\Models\Image::where('imageable_id',$post->id)->
                where('imageable_type', 'App\Models\Post')->delete();
            $post->delete();
            return redirect('users/profile/'.session('profile')['username']);
        }
        return back()->withErrors([
            'delete' => 'Type delete to confirm'
        ]);
        
    }
}
