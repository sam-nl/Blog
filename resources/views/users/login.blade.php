@extends('main')

@section('title')
Glob login
@endsection

@section('links')
<li><a href="/home">Home</a></li>
<li><a href="/users/create">Register</a></li>
@endsection

@section('content')

<form action="/users/auth" method="POST">
    <div class = "centre-form">
        <h1>Login</h1>
        <hr>
    </div> 
    <div class = "centre-form">
        <b>Username   </b>
        <input type="text" placeholder="Enter Username" name="username" id="username" value="{{old('username')}}" required>
        @error('username')<div class = "err"><p>{{$message}}<p></div>@enderror
    </div>
    <div class = "centre-form">
        <b>Password   </b>
        <input type="password" placeholder="Enter Password" name="password" id="password" required>
        @error('password')<div class = "err"><p>{{$message}}<p></div>@enderror
    </div>   
    @csrf
    <div class = "centre-form">
        <hr>
        <button type="submit" >Login</button>
    </div>
    
</form>

@endsection