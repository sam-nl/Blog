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

Route::get('/home', 'App\Http\Controllers\PagesController@getHome');
Route::get('/profile', 'App\Http\Controllers\PagesController@getProfile');
//Route::redirect('/profile', '/home', 301);

Route::get('/profile/{id}', function ($id) {
    return "profile page".$id;
});

Route::get('/profile/{id}/{commentId}', function ($id, $commentId) {
    return "user page".$id." comment id". $commentId;
});

