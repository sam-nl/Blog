<?php

use Illuminate\Support\Facades\Route;
use carbon\carbon;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/tests', function () {
    return view('users/create');
});


Route::get('/home', 'App\Http\Controllers\PagesController@getHome');

Route::get('/users/login','App\Http\Controllers\UserController@login');
Route::post('/users/auth','App\Http\Controllers\UserController@auth');
Route::get('/users/logout','App\Http\Controllers\UserController@logout');
Route::get('/users','App\Http\Controllers\UserController@index');
Route::get('/users/create','App\Http\Controllers\UserController@create');
Route::post('/users','App\Http\Controllers\UserController@store');
Route::get('/users/profile/find','App\Http\Controllers\UserController@findProfile');
Route::get('/users/show/{user}','App\Http\Controllers\UserController@show');
Route::get('/users/profile/{user}','App\Http\Controllers\UserController@displayProfile');
Route::get('/users/profile/{user}/edit','App\Http\Controllers\UserController@edit');
Route::put('/users/profile/{user}/update','App\Http\Controllers\UserController@update');
Route::get('/users/admin','App\Http\Controllers\UserController@adminHome');


Route::get('/posts','App\Http\Controllers\PostController@index');
Route::get('/posts/create','App\Http\Controllers\PostController@create');
Route::post('/posts','App\Http\Controllers\PostController@store');
Route::get('/posts/{post}/edit','App\Http\Controllers\PostController@edit');
Route::put('/posts/{post}/update','App\Http\Controllers\PostController@update');
Route::delete('/posts/{post}/delete','App\Http\Controllers\PostController@destroy');

Route::get('/comments/{comment}/edit','App\Http\Controllers\CommentController@edit');




//Route::redirect('/profile', '/home', 301);
/*
Route::get('/profile/{id}', function ($id) {
    return "profile page".$id;
});
*/


