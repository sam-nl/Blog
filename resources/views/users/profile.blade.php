@extends('main')

@section('title')
Glob profile
@endsection

@section('links')
@if  (Auth::user()->id != session('profile')['id'])
    @if  (Auth::user()->permissions== 1)
        <li class ="links"><a href="/users/admin">Back to admin home</a></li>
    @else
        <li class ="links"><a href="/users/show/{{Auth::user()->id}}">Back to my profile</a></li>
    @endif 
@else
    <li class ="links"><a href="/posts/create">New post</a></li>
    <li class ="links"><a href="/users/profile/{{Auth::user()->username}}/edit">Edit profile</a></li>
@endif
<li class ="links"><a href="/users/logout">Logout</a></li>
@endsection  

@section('content') 
<!--Banner-->
<section class = "banner py-2">
    
        <div class="row">
            <div class = "col-lg-8">
                <img class = "w-100 image-fluid" src={{ url('images/'.\App\Models\Image::where('imageable_id',session('profile')['id'])->
                where('imageable_type', 'App\Models\User')->first('filename')['filename']) }}>
            </div>
            <div class = "col-lg-4">
                <div class = "column">
                    <div>
                        @if (Auth::user()->id == session('profile')['id'])
                            <h1>Welcome to your profile {{Auth::user()->username}} </h1>
                        @else
                            <h1>Welcome to {{session('profile')['username']}}'s profile </h1>
                        @endif
                        <hr>
                    </div>
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
    
</section>
<!--Posts-->
<section class = "posts">
    
        <h1 class = "text-center"> {{session('profile')['username']}}'s posts </h1>
        <hr>
        @if (sizeof($posts->get()) == 0)
            <div class = 'center'>
                <p>No posts yet!</p>
            </div>
        @endif
    
    @foreach  ($posts = $posts->paginate(5) as $post)
        
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
                    @if  (Auth::user()->id == session('profile')['id'])
                        <div>
                            <form action="/posts/{{$post['id']}}/edit" method="GET">
                                <button class="btn btn-lg btn-primary"  type = "submit" >Edit</button>
                            </form>
                        </div>
                    @endif
                    @if  (session('user')['permissions']== 1)
                        <form action="/posts/{{$post->id}}/delete" method="POST">
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
                        Posted by {{session('profile')['username']}}
                        On {{ $day = date("l", strtotime($post['created_at']))}}
                    </p>
                </div>
            </div>
            <hr>
        
    @endforeach   
</section>

    <div>
        <p>
        {{$posts->links('pagination::bootstrap-4')}}
        </p>
    </div>
@endsection