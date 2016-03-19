<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});


Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
});

Route::group(array('prefix'=> '/forum'), function()
{
    Route::get('/', array('uses' => 'ForumController@index', 'as' => 'forum-home'));
    Route::get('/category/{id}', array('uses' => 'ForumController@category', 'as' => 'forum-category'));
    Route::get('/thread/{id}', array('uses' => 'ForumController@thread', 'as' => 'forum-thread'));
});