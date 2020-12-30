@extends('main')

@section('title')
Create new tag
@endsection

@section('links')
<li class ="links"><a href="/users/admin">Back to admin home</a></li>
@endsection

@section('content')
<form action="/tags" method="POST">
    <div class = "centre-form">
        <b>New tag</b>
    </div>
    <div class = "centre-form">   
        <b>Name   </b>
        <input type="text" placeholder="Tag Name" name="tag" id="tag" value="{{old('tag')}}" required>
        @error('tag')<div class = "err"><p>{{$message}}<p></div>@enderror
    </div>

    
    @csrf
    <div class = "centre-form">
        <hr>
        <button type="submit" >Create</button>
    </div>
</form>

@endsection