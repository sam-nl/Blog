<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Tag;
use Illuminate\Support\Facades\DB;
use \App\Models\Post;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tag)
    {       
        $tag = Tag::where('name',$tag)->first();
        if ($tag!=null){
            $postids = DB::table('post_tag')->where('tag_id', $tag->id)->get('post_id');
            $posts= [];
            foreach ($postids as $pid){
                array_push($posts,Post::find($pid->post_id)); 
            }
            return view("tags/index", compact('posts','tag'));
        }
        else{
            return back()->withErrors([
                'tag' => 'Tag not found!',
            ]); 
        }
    }
    function find(Request $request){

        $tagname = $request->tag;
        $tag = Tag::where('name',$tagname)->first();
        if ($tag!=null){
            return redirect('/tags/index/'.$tagname);
        }
        else{
            return back()->withErrors([
                'tag' => 'tag not found',
            ]);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->permissions == 1){
            return view('tags/create');
        }
        else{
            return back();
        } 
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tag = $request->tag;
        if ($tag == null){
            return back()->withErrors([
                'tag' => 'Enter a tag',
            ]);
        }
        if (Tag::where('name',$tag)->first()!=null){
            return back()->withErrors([
                'tag' => 'Tag already exists!',
            ]);
        }
        $tag = Tag::create(['name'=>$tag]);
        return redirect('users/admin');
    }
}