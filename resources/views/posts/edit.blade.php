@extends('main')

@section('title')
Edit post
@endsection

@section('links')
<li class ="links"><a href="/users/show/{{$user->username}}">Back to profile</a></li>
@endsection

@section('content')
<form action="update" method="POST">
    @method('PUT')
    <div class = "centre-form">
        <b>Edit Post</b>
    </div>
    <div class = "centre-form">
        <textarea rows="10" cols="50" type="text" placeholder="Enter Post" name="content" id="content" required>{{$post->content}}</textarea>
        @error('content')<div class = "err"><p>{{$message}}<p></div>@enderror
    </div>
    @csrf
    <div class = "centre-form">
        <button class="btn btn-lg btn-primary" type="submit" >edit</button>
        <hr>
    </div>
    </form>
    <form action="delete" method="POST">
        @method("DELETE")
        <div class = "centre-form">
            <b>DELETE POST</b>
        </div>
        <div class = "centre-form">
            <p style = "font-size: 16px">Type "delete" to confirm</p>
        </div>
        <div class = "centre-form">   
            <input type="text" placeholder="Confirmation" name="delete" id="delete" required>
            @error('delete')<div class = "err"><p>{{$message}}<p></div>@enderror
        </div>
        @csrf
        <div class = "centre-form">
            <hr>
            <button class="btn btn-lg  btn-danger" type="submit" >DELETE</button>
        </div>
    </form>
@endsection