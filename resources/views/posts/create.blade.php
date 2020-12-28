@extends('main')

@section('title')
Create new post
@endsection


@section('content')
<form action="/posts" method="POST">
    <div class = "centre-form">
        <b>New Post</b>
    </div>
    <div class = "centre-form">
        <textarea rows="10" cols="50" type="text" placeholder="Enter Post" name="content" id="content" value="{{old('content')}}" required></textarea>
        @error('content')<div class = "err"><p>{{$message}}<p></div>@enderror
    </div>
    @csrf
    <div class = "centre-form">
        <hr>
        <button type="submit" >Post</button>
    </div>
    
</form>

@endsection