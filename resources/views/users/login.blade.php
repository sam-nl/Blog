@extends('main')

@section('title')
Glob login
@endsection

@section('links')
<li class ="links"><a href="/users/create">Register</a></li>
@endsection

@section('content')
    <form action="/users/auth" method="POST">
        <div class = "row">
            <div class = "col-lg-4">
            </div>
            <div class = "col-lg-4">
        <div class = "centre-form">
            <h1>Login</h1>
            <hr>
        </div> 
        <div class = "centre-form">
            <b>Username</b>
            
                <input class = "form-control py-2" type="text" placeholder="Enter Username" name="username" id="username" value="{{old('username')}}" required>
                @error('username')<div class = "err"><p>{{$message}}<p></div>@enderror
            
        </div>
        <div class = "centre-form">
            <b>Password   </b>
            <input class = "form-control py-2" type="password" placeholder="Enter Password" name="password" id="password" required>
            @error('password')<div class = "err"><p>{{$message}}<p></div>@enderror
        </div>   
        @csrf
        <div class = "centre-form">
            <hr>
            <div class = "col">
                <div>
                    <button class="btn btn-lg btn-primary" type="submit" >Login</button>
                </div>
                <div class = "py-4">
                    <button class="btn btn-lg btn-warning" type="button">Forgotten password</button>
                </div>
            </div>
        </div> 
    </div>
</div>       
    </form>
@endsection