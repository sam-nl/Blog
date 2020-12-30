@extends('main')
@section('title')
Admin home
@endsection

@section('links')
<li class ="links"><a href="/tags/create">New Tag</a></li>
<li class ="links"><a href="/users">See user list</a></li>
<li class ="links"><a href="/users/logout">Logout</a></li>

@endsection  

@section('content') 
<article>
    
    <div class="article-centre">
        <p> 
           Welcome admin
        </p>
    </div>
    
    <form action="/users/profile/find" method="GET" class = "left">
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
    
    
    
    <hr>
    
</article> 
@endsection
