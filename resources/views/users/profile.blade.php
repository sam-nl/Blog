@extends('main')
@section('title')
Glob profile
@endsection

@section('links')
<li><a href="#edit">Edit Profile</a></li>
<li><a href="">show</a></li>
<li><a href="/users/logout">Logout</a></li>
@endsection  

@section('content') 
<article>
    <p>welcome {{session('username')}}</p>
    <div class="article-centre">
        <p> 
            POST GOES HERE
        </p>
    </div>
    <div class="article-centre">
        <p>
            POST GOES HERE POST GOES HERE POST GOES HERE POST GOES HERE POST GOES HERE 
            POST GOES HERE POST GOES HERE POST GOES HERE POST GOES HERE POST GOES HERE
        </p>
    </div>
</article> 
@endsection



            
            
            
