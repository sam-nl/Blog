@extends('main')

@section('title')
Create tag
@endsection

@section('links')
<li class ="links"><a href="/users/admin">Back to admin home</a></li>
@endsection

@section('content')
    <form action="/tags" method="POST">
        <div class = "centre-form py-4">
            <h3>New tag</h3>
        </div>
        <div class = "centre-form">   
            <b>Name   </b>
            <input type="text" placeholder="Tag Name" name="tag" id="tag" value="{{old('tag')}}" required>
            @error('tag')<div class = "err"><p>{{$message}}<p></div>@enderror
        </div>
        @csrf
        <div class = "centre-form">
            <hr>
            <button class="btn btn-lg btn-primary" type="submit" >Create</button>
        </div>
    </form>

@endsection