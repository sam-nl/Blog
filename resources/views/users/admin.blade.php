@extends('main')
@section('title')
Admin home
@endsection

@section('links')

<li><a href="/users">See user list</a></li>
<li><a href="/users/logout">Logout</a></li>
@endsection  

@section('content') 
<article>
    
    <div class="article-centre">
        <p> 
           Welcome admin
        </p>
    </div>
    
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
    
    
    
    <hr>
    
</article> 
@endsection
