@extends('main')

@section('title')
Glob home
@endsection

@section('links')
@if (Auth::user()!=null)
    <li class ="links"><a href="/users/show/{{Auth::user()->id}}">Go to profile</a></li>
@else
    <li class ="links"><a href="/users/login">Login</a></li>
    <li class ="links"><a href="/users/create">Register</a></li>
@endif

@endsection

@section('content')

    <div class= "row">
        <div class = "col-lg-3 py-4">
            <h1 class = "text-center">Welcome to Glob</h1>
        </div>
        <div class = "col-lg-6 py-4">
            <div class = "column">
                <div class = "text-center"> 
                    <p>Glob is a blogging website.</p>
                </div>
                <div class = "text-center"> 
                    <b>You can make posts with images.</b>
                </div>
                <div class = "text-center"> 
                    <b>You can also view and comment on posts. </b>
                </div>
                <div class = "text-center"> 
                    <h3>Enjoy globbing!</h3>
                </div>
            </p>
            </div>
        </div>
        <div class = "col-lg-2 py-4 " >
            <img class="w-100 image-fluid" src="{{ url('/images/glob.png') }}">
        </div>
    
    
    @if (Auth::user() == null)
        <hr>
        <div class = "row">
                <h2 class = "text-center">
                    You are not currently logged in, register or login
                    with the links at the top.
                </h2>
        </div> 
    @endif
@endsection
