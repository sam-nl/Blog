@extends('main')

@section('title')
Glob edit
@endsection

@section('links')
<li class ="links"><a href="/home">Home</a></li>
<li class ="links"><a href="/users/show/{{session('user')['id']}}">Profile</a></li>
@endsection

@section('content')

<form action="update" method="POST">
@method('PUT')
    <div class = "centre-form">
        <b>Change username</b>
    </div>
    <div class = "centre-form">
        <input type="text" placeholder="New Username" name="username" id="username" value="{{session('user')['username']}}" required>
        @error('username')<div class = "err"><p>{{$message}}<p></div>@enderror
    </div>
    @csrf
    <div class = "centre-form">
        <button type="submit" >edit username</button>
        <hr>
    </div>
</form>
<form action="update" method="POST">
    @method('PUT')
    <div class = "centre-form">
        <b>Change Email</b>
    </div>
    <div class = "centre-form">   
        <input type="text" placeholder="New Email" name="email" id="email" value="{{session('user')['email']}}" required>
        @error('email')<div class = "err"><p>{{$message}}<p></div>@enderror
    </div>
    @csrf
    <div class = "centre-form">
        <button type="submit" >edit email</button>
        <hr>
    </div>
</form>
<form action="update" method="POST">
    @method('PUT')
    <div class = "centre-form">
        <b>Change password</b>
    </div>
    
    <div class = "centre-form">
        <input type="password" placeholder="New Password" name="password" id="password" required>
        @error('password')<div class = "err"><p>{{$message}}<p></div>@enderror
    </div>  
    @csrf
    <div class = "centre-form">
        <button type="submit" >edit password</button>
        <hr>
    </div>
</form>

@endsection