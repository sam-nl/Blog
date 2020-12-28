@extends('main')
@section('title')
Glob profile
@endsection

@section('links')

@if  (session('user')['id'] != session('profile')['id'])
    <li><a href="/users/show/{{session('user')['id']}}">Back to my profile</a></li>
    
@else
    <li><a href="/posts/create">New post</a></li>
    <li><a href="/users/profile/{{session('user')['username']}}/edit">Edit profile</a></li>
@endif

<li><a href="/users/logout">Logout</a></li>
@endsection  

@section('content') 
<article>
    @if (session('user')['id'] == session('profile')['id'])
        <div class="title-msg">
            <h1>welcome {{session('user')['username']}}</h1>
        </div>
    @else
    <div class="title-msg">
        <h1>{{session('profile')['username']}}'s posts</h1>
    </div>
    @endif
    <form action="/users/profile/find" method="GET">
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
    
    @if (sizeof(\App\Models\Post::where('user_id',session('profile')['id'])->get()) ==0)
        <div class="article-centre">
        <p>No posts yet!</p>
        </div>
    @endif
    @foreach  (\App\Models\Post::where('user_id',session('profile')['id'])->get()->reverse() as $post)
    <div class="article-centre">
        <p> 
            {{$post['content']}}
            @if  (session('user')['id'] == session('profile')['id'])
            <form action="/posts/{{$post['id']}}/edit" method="GET">
                <button  type = "submit" >Edit</button>
            </form>
            @endif
        </p>
    </div>
    
    <div class = "post-info">
        <p style = 'font-size: 12px'>
            Posted by 
            {{
                session('profile')['username']
            }}
            On 
            {{
                $day = date("D", strtotime($post['created_at'])).'day'
            }}
            
        </p>
    </div>
    <div class="article-comment" style = "display:block">
        @foreach  (\App\Models\Comment::where('post_id',$post['id'])->get() as $comment)
            <div>
                <p> 
                       
                    {{
                        \App\Models\User::where('id',$comment['user_id'])->first('username')['username'].'  commented:  '.$comment['content']
                    }}
                    
                </p>
            </div>
            <hr>
            
        @endforeach
    </div>
    
    
    <hr>
    @endforeach
</article> 
@endsection



            
            
            
