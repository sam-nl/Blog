@extends('main')

@section('title')
Glob home
@endsection

@section('links')
<li><a href="/users/login">Login</a></li>
<li><a href="/users/create">Register</a></li>
@endsection

@section('content')
<article>
    <div class="article-centre">
        <p> 
            Glob is website for gamers.
            You can make posts about the games you play.
            You can also view other people's posts. Enjoy globbing!
        </p>
    </div>
    @if (session('user')==null)
    <div class="article-centre">
        <p>
            You are not currently logged in, register or login
            with the links at the top.
        </p>
    </div>
        
    @endif
    
</article>
@endsection