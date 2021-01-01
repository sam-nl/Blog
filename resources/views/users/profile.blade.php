@extends('main')
@section('title')
Glob profile
@endsection

@section('links')

@if  (session('user')['id'] != session('profile')['id'])
    @if  (session('user')['permissions']== 1)
        <li class ="links"><a href="/users/admin">Back to admin home</a></li>
    @else
        <li class ="links"><a href="/users/show/{{session('user')['id']}}">Back to my profile</a></li>
    @endif

    
    
@else
    <li class ="links"><a href="/posts/create">New post</a></li>
    <li class ="links"><a href="/users/profile/{{session('user')['username']}}/edit">Edit profile</a></li>
@endif

<li class ="links"><a href="/users/logout">Logout</a></li>
@endsection  

@section('content') 
<article>
    <form action="/users/profile/find" method="GET" class="left">
        <div class = "centre-form">
            <b>Search user</b>
            <input type="text" placeholder="Search" name="username" id="username" value="{{old('username')}}" required>
            @error('username')<div class = "err"><p>{{$message}}<p></div>@enderror
        </div>
        <div class = "centre-form">
            <hr>
            <button type="submit">Search</button>
        </div>
    </form>
    <form action="/tags/find" method="GET" class = "left">
        <div class = "centre-form">
            <b>Search for tags</b>
            <input type="text" placeholder="Search" name="tag" id="tag" value="{{old('tag')}}" required>
            @error('tag')<div class = "err"><p>{{$message}}<p></div>@enderror
        </div>
        <div class = "centre-form">
            <hr>
            <button type="search">Search</button>
        </div>
    </form>
    <div class="title-msg">
        @if (session('user')['id'] == session('profile')['id'])
            
                <h1>welcome {{session('user')['username']}}</h1>
                
            
        @else
        
            <h1>{{session('profile')['username']}}'s posts </h1>
            
    
        @endif
        <img src={{ url('images/'.\App\Models\Image::where('imageable_id',session('profile')['id'])->
        where('imageable_type', 'App\Models\User')->first('filename')['filename']) }}>
    </div>
    
        
        
   
    @if (sizeof($posts->get()) == 0)
        <div class="article-centre">
        <p>No posts yet!</p>
        </div>
    @endif
    
    @foreach  ($posts = $posts->paginate(5) as $post)
    
        <div class="article-centre">

                <p>{{$post['content'] }}</p>
                <p>{{$post['id'] }}</p>
                <a href="/posts/{{$post['id']}}/view">View post</a>
                @if(\App\Models\Image::where('imageable_id',$post->id)->
                where('imageable_type', 'App\Models\Post')->first('filename')['filename'] !=null)
                <img src={{ url('images/'.\App\Models\Image::where('imageable_id',$post->id)->
                where('imageable_type', 'App\Models\Post')->first('filename')['filename']) }}>
                @endif
                
                @if  (session('user')['id'] == session('profile')['id'])
                    <form action="/posts/{{$post['id']}}/edit" method="GET">
                        <button  type = "submit" >Edit</button>
                    </form>
                @endif
                
            
        </div>
        @if  (session('user')['permissions']== 1)
        <form action="/posts/{{$post->id}}/delete" method="POST">
            <div class = "centre-form">
                <p style = "font-size: 16px">Type "delete" to remove</p>
            </div>
            <div class = "centre-form">   
                <input type="text" placeholder="Confirmation" name="delete" id="delete" required>
                @error('delete')<div class = "err"><p>{{$message}}<p></div>@enderror
            </div>
        @method('DELETE')  
            <button  type = "submit" >DELETE</button>
            @csrf
        </form>
        @endif
        <div class = "post-info">
            <p style = 'font-size: 12px'>
                Posted by {{session('profile')['username']}}
                On {{ $day = date("D", strtotime($post['created_at'])).'day'}}
            </p>
        </div>
        
    </div>
    @endforeach

    <hr>
    
    <div class = "middle" style = "grid-column: 2">
        <p>
        {{$posts->links('pagination::bootstrap-4')}}
        </p>
    </div>
</article> 
@endsection



            
            
            
