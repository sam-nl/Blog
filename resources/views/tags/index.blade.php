@extends('main')

@section('title')
Glob profile
@endsection

@section('links')
@if  (Auth::user()->permissions== 1)
    <li class ="links"><a href="/users/admin">Back to admin home</a></li>
@else
    <li class ="links"><a href="/users/show/{{Auth::user()->username}}">Back to my profile</a></li>
@endif
<li class ="links"><a href="/users/logout">Logout</a></li>
@endsection  

@section('content') 
    <div class = "row">
        <div class = "col-lg-8">
            <div class = "text-center">
                <h1> Posts about {{$tag->name}}</h1>
                <p> On this page we find everything {{$tag->name}} related! </p>
            </div>
        </div>
        <div class = "col-lg-4">
            <div class = "column">
                <div>
                    <form action="/users/profile/find" method="GET" class="left">
                        <div class="active-purple-3 active-purple-4 mb-4">
                            <b>Search for users</b>
                            <input class = "form-control" type="text" placeholder="Search" name="username" id="username" value="{{old('username')}}" required>
                            @error('username')<div class = "err"><p>{{$message}}<p></div>@enderror
                            <button class="btn btn-lg btn-primary" type="submit">Search</button>
                        </div>
                    </form>
                </div>
                <div>
                    <form action="/tags/find" method="GET" class = "left">
                        <div class="active-purple-3 active-purple-4 mb-4">
                            <b>Search for tags</b>
                            <input class = "form-control" type="text" placeholder="Search" name="tag" id="tag" value="{{old('tag')}}" required>
                            @error('tag')<div class = "err"><p>{{$message}}<p></div>@enderror
                            <button class="btn btn-lg btn-primary" type="search">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <hr>
    @if (sizeof($posts) ==0)
        <div class="row">
        <p>No posts yet!</p>
        </div>
    @endif
    
    @foreach  (array_reverse($posts) as $post)
    
        <div class="row">
            <div class = "col-lg-6">
                <p>{{$post['content'] }}</p>
            </div>            
            @if(\App\Models\Image::where('imageable_id',$post->id)->
            where('imageable_type', 'App\Models\Post')->first('filename')['filename'] !=null)
                <div class = "col-lg-4">
                    <img class = "w-100 image-fluid" src={{ url('images/'.\App\Models\Image::where('imageable_id',$post->id)->
                    where('imageable_type', 'App\Models\Post')->first('filename')['filename']) }}>
                </div>
            @endif
            <div class = "col-lg-2">
                @if  (session('user')['permissions']== 1)
                    <form action="/posts/{{$post['id']}}/delete" method="POST">
                        <div>
                            <p style = "font-size: 16px">Type "delete" to remove</p>
                        </div>
                        <div>   
                            <input type="text" placeholder="Confirmation" name="delete" id="delete" required>
                            @error('delete')<div class = "err"><p>{{$message}}<p></div>@enderror
                        </div>
                        @method('DELETE')  
                        @csrf
                        <button class="btn btn-lg  btn-danger" type = "submit" >DELETE</button>    
                    </form>
                @endif
            </div>  
        </div>        
        <div class = "row">        
            <div class = "col-lg-4">
                <a href="/posts/{{$post['id']}}/view">View post</a>
            </div>
            <div class = "col-lg-8">
                <p style = 'font-size: 12px'>
                    Posted by {{\App\Models\User::where('id',$post['user_id'])->get()->first()->username}}
                    On {{ $day = date("l", strtotime($post['created_at']))}}
                </p>
            </div>
        </div>
        <hr>
    
    @endforeach   

@endsection




            
            
            
