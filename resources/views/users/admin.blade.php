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
        <div class= "row">
            <div class = "col-lg-4 py-1">
                <h1> Welcome admin </h1>
            </div>
            <div class = "col-lg-4 py-1">
                <form action="/users/profile/find" method="GET" class = "left">
                        <b>Search users</b>
                        <input type="text" placeholder="Search" name="username" id="username" value="{{old('username')}}" required>
                        @error('username')<div class = "err"><p>{{$message}}<p></div>@enderror                  
                        <button class="btn btn-lg btn-primary" type="submit">Search</button>                   
                </form>
            </div>
            <div class = "col-lg-4 py-1">
                <form action="/tags/find" method="GET" class = "left">                   
                        <b>Search by tag</b>
                        <input type="text" placeholder="Search" name="tag" id="tag" value="{{old('tag')}}" required>
                        @error('tag')<div class = "err"><p>{{$message}}<p></div>@enderror                   
                        <button class="btn btn-lg btn-primary" type="search">Search</button>                   
                </form>
            </div>
        </div>
@endsection
