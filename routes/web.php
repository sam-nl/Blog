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

Route::get('/home', function () {
    return "homepage";
});

Route::get('/users/{id}', function ($id) {
    return "user page".$id;
});

Route::get('/users/{id}/{commentId}', function ($id, $commentId) {
    return "user page".$id." comment id". $commentId;
});

