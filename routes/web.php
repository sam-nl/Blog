<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/users/profile', 'App\Http\Controllers\PagesController@getProfile');

Route::get('/users/login','App\Http\Controllers\UserController@login');
Route::post('/users/auth','App\Http\Controllers\UserController@auth');
Route::get('/users/logout','App\Http\Controllers\UserController@logout');
Route::get('/users','App\Http\Controllers\UserController@index');
Route::get('/users/create','App\Http\Controllers\UserController@create');
Route::post('/users','App\Http\Controllers\UserController@store');
Route::get('/users/profile/{user}','App\Http\Controllers\UserController@show');


Route::get('/posts','App\Http\Controllers\PostController@index');
Route::get('/posts/create','App\Http\Controllers\PostController@create');
Route::post('/posts','App\Http\Controllers\PostController@store');
Route::get('/posts/{post}','App\Http\Controllers\PostController@show');







//Route::redirect('/profile', '/home', 301);
/*
Route::get('/profile/{id}', function ($id) {
    return "profile page".$id;
});
*/


