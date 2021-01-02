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

//accessable while logged out
Route::get('/home', 'App\Http\Controllers\PagesController@getHome');
Route::get('/', 'App\Http\Controllers\PagesController@getHome');
Route::get('login','App\Http\Controllers\PagesController@getHome')->name('login');
Route::get('/users/login','App\Http\Controllers\UserController@login');
Route::post('/users/auth','App\Http\Controllers\UserController@auth');
Route::get('/users/logout','App\Http\Controllers\UserController@logout');
Route::get('/users/create','App\Http\Controllers\UserController@create');
Route::post('/users','App\Http\Controllers\UserController@store');
//require login
Route::get('/users','App\Http\Controllers\UserController@index')->middleware('auth');
Route::get('/users/profile/find','App\Http\Controllers\UserController@findProfile')->middleware('auth');
Route::get('/users/show/{user}','App\Http\Controllers\UserController@show')->middleware('auth');
Route::get('/users/profile/{user}','App\Http\Controllers\UserController@displayProfile')->middleware('auth');
Route::get('/users/profile/{user}/edit','App\Http\Controllers\UserController@edit')->middleware('auth');
Route::put('/users/profile/{user}/update','App\Http\Controllers\UserController@update')->middleware('auth');
Route::get('/users/admin','App\Http\Controllers\UserController@adminHome')->middleware('auth');

Route::get('/posts','App\Http\Controllers\PostController@index')->middleware('auth');
Route::get('/posts/create','App\Http\Controllers\PostController@create')->middleware('auth');
Route::post('/posts','App\Http\Controllers\PostController@store')->middleware('auth');
Route::get('/posts/{post}/edit','App\Http\Controllers\PostController@edit')->middleware('auth');
Route::get('/posts/{post}/view','App\Http\Controllers\PostController@view')->middleware('auth');
Route::put('/posts/{post}/update','App\Http\Controllers\PostController@update')->middleware('auth');
Route::delete('/posts/{post}/delete','App\Http\Controllers\PostController@destroy')->middleware('auth');

Route::get('/comments/{comment}/edit','App\Http\Controllers\CommentController@edit')->middleware('auth');
Route::get('/tags/index/{tag}','App\Http\Controllers\TagController@index')->middleware('auth');
Route::get('/tags/find','App\Http\Controllers\TagController@find')->middleware('auth');
Route::get('/tags/create','App\Http\Controllers\TagController@create')->middleware('auth');
Route::post('/tags','App\Http\Controllers\TagController@store')->middleware('auth');