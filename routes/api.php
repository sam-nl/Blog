<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('posts/{post}/comments','App\Http\Controllers\CommentController@apiindex');
Route::post('posts/{post}/comments','App\Http\Controllers\CommentController@apistore');
Route::get('posts/comments','App\Http\Controllers\CommentController@index');
Route::post('posts/comments','App\Http\Controllers\CommentController@store');

