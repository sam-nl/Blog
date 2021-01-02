@extends('main')

@section('title')
Glob register
@endsection

@section('links')
<li class = links><a href="/users/login">Login</a></li>
@endsection

@section('content')
<form action="/users" method="POST">
    <div class = "centre-form">
        <h1>Register</h1>
        <p>Please fill in this form to create an account.</p>
        <hr>
    </div> 
    <div class = "centre-form">
        <b>Username   </b>
        <input type="text" placeholder="Enter Username" name="username" id="username" value="{{old('username')}}" required>
        @error('username')<div class = "err"><p>{{$message}}<p></div>@enderror
    </div>
    <div class = "centre-form">   
        <b>Email   </b>
        <input type="text" placeholder="Enter Email" name="email" id="email" value="{{old('email')}}" required>
        @error('email')<div class = "err"><p>{{$message}}<p></div>@enderror
    </div>
    <div class = "centre-form">
        <b>Password   </b>
        <input type="password" placeholder="Enter Password" name="password" id="password" required>
        @error('password')<div class = "err"><p>{{$message}}<p></div>@enderror
    </div>   
    @csrf
    <div class = "centre-form">
        <hr>
        <button class="btn btn-lg btn-primary" type="submit" >Register</button>
    </div>
</form>
@endsection