@extends('main')

@section('title')
Glob home
@endsection

@section('links')
<li><a href="/profile">Login</a></li>
<li><a href="#register">Register</a></li>
@endsection

@section('content')
<div class="article-centre">
    <p> 
        Glob is website for gamers.
        You can make posts about the games you play.
        You can also view other people's posts. Enjoy globbing!
    </p>
</div>
<div class="article-centre">
    <p>
        You are not currently logged in, register or login
        with the links at the top.
    </p>
</div>
@endsection