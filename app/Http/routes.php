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

/*Route::group(array('prefix'=> '/forum'), function()
{
    Route::get('/', array('uses' => 'ForumController@index', 'as' => 'forum-home'));
    Route::get('/category/{id}', array('uses' => 'ForumController@category', 'as' => 'forum-category'));
    Route::get('/thread/{id}', array('uses' => 'ForumController@thread', 'as' => 'forum-thread'));
});*/
Route::group(['middleware' => 'web'], function ()
{
    Route::group(['prefix'=> '/forum'], function ()
    {
        Route::auth();

        Route::get('/',[
            'as' => '/forum-home', 'uses' =>'ForumController@index'
        ]);
        Route::get('/category/{id}',[
           'as'=> 'forum-category', 'uses' => 'ForumController@category'
        ]);
        Route::get('/thread/{id}',[
            'as'=> 'forum-thread', 'uses' => 'ForumController@thread'
        ]);
        Route::group(['before'=> 'admin'], function ()
        {
            Route::get('/group/{id}/delete',[
                'as'=> 'forum-delete-group', 'uses' => 'ForumController@deleteGroup'
            ]);
            Route::get('/category/{id}/delete',[
                'as'=> 'forum-delete-category', 'uses' => 'ForumController@deleteCategory'
            ]);
            Route::group(['before'=> 'csrf'], function ()
            {
                Route::post('/group', [
                    'as' => 'forum-store-group', 'uses' => "ForumController@storeGroup"
                ]);
            });

        });
    });

        Route::group(['before'=> 'auth'], function ()
        {
            Route::get('/thread/{id}/new', [
                'as' => 'forum-get-new-thread', 'uses' => "ForumController@newThread"
            ]);
            Route::group(['before'=> 'csrf'], function ()
            {
                Route::post('/thread/{id}/new', [
                    'as' => 'forum-store-thread', 'uses' => "ForumController@storeThread"
                ]);
            });
        });

});
//'ForumController@index')->name('forum-home');
//Route::get('/category/{id}','ForumController@category');
//Route::get('/category/{id}', array('uses' => 'ForumController@category', 'as' => 'forum-category'));
//Route::get('/thread/{id}', array('uses' => 'ForumController@thread', 'as' => 'forum-thread'));
// Route::get('/forum',['as' => 'forum-home', 'uses'=> 'ForumController@index']);
//Route::get('/forum','ForumController@index')-> name('forum-home');
//Route::get('/forum','ForumController@index');
//Route::get('/category/{id}','ForumController@category');