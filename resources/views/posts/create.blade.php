@extends('main')

@section('title')
Create post
@endsection

@section('links')
<li class ="links"><a href="/users/show/{{$user->id}}">Back to profile</a></li>

@endsection

@section('content')

    <form action="/posts" method="POST" enctype="multipart/form-data">
        <div class = "centre-form py-4">
            <h1>New Post</h1>
        </div>
        <div class = "centre-form">
            <textarea rows="10" cols="50" type="text" placeholder="Enter Post" name="content" id="content" value="{{old('content')}}" required></textarea>
            @error('content')<div class = "err"><p>{{$message}}<p></div>@enderror
        </div>
        <div class = "centre-form">
            <hr>
            <b>Choose an image</b>
        </div>
        <div class = "centre-form">
            <input type ="file" name = "image">
            @error('image')<div class = "err"><p>{{$message}}<p></div>@enderror
        </div>
        <div class = "centre-form">
            <hr>
            <b>Add some tags</b>
        </div>
        <div class = "centre-form">
            <div>
            <select name="tags[]" id="tags" multiple="multiple" class = "custom-select">
                @foreach  ($tags as $tag)
                    <p>
                        <option value={{$tag->id}}>{{$tag->name}}</option> 
                    </p>
                @endforeach
            </select>
            @error('tags')<div class = "err"><p>{{$message}}<p></div>@enderror
            </div>
        </div>
        @csrf
        <div class = "centre-form">
            <hr>
            <button class="btn btn-lg btn-primary" type="submit" >Post</button>
        </div>
    </form>

@endsection