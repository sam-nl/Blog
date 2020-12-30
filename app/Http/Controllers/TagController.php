<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Tag;
use Illuminate\Support\Facades\DB;

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
                $postids = DB::table('post_tag')
                ->where('tag_id', $tag->id)
                ->get('post_id');
                $posts= [];
                foreach ($postids as $pid){
                    array_push($posts,\App\Models\Post::find($pid->post_id)); 
                }
                
                return view("tags/index", compact('posts','tag'));
            }
            else{
                dd('tag null');
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
        return view('tags/create');
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
