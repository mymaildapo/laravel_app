<?php

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
//@index is function in PagesController.php
Route::get('/', 'PagesController@index'); //lsapp\app\Http\Controllers\PagesController.php
Route::get('/about', 'PagesController@about');
Route::get('/services','PagesController@services');
Route::get('/welcome','PagesController@welcome');

//now we can go to 8000/post 
//it will go to new page and post is not in view /we dont have posts.blade.php.(page generate auto)
Route::resource('posts','PostController'); //posts can be any name //it just create bunch of post/create,update,delete e.t.c from app\Http\Controllers\PostController.php functions
//it will make a route like posts/ with every function inside PostController app\Http\Controllers\PostController.php

Auth::routes();

Route::get('/dash', 'DashBoardController@index');
