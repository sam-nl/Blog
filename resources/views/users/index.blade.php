@extends('main')

@section('title')
User List
@endsection

@section('links')
    <li class ="links"><a href="/users/admin">Back to admin home</a></li>
@endsection

@section('content')

    <h1>Users and links to profiles</h1>
    @forelse($users as $user)
        <div>
            <a href="users/show/{{$user->id}}">Username: {{$user->username}}</a>
            <p>Id: {{$user->id}}</p>
            <p>Email: {{$user->email}}</p>
            <hr>
        </div>
    @empty
        <p>No Users!</p>
    @endforelse

@endsection