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

/*Route::group(array('prefix'=> '/forum'), function()
{
    Route::get('/', array('uses' => 'ForumController@index', 'as' => 'forum-home'));
    Route::get('/category/{id}', array('uses' => 'ForumController@category', 'as' => 'forum-category'));
    Route::get('/thread/{id}', array('uses' => 'ForumController@thread', 'as' => 'forum-thread'));
});*/
Route::group(['middleware' => 'web'], function ()
{
    Route::auth();
    Route::get('/', 'HomeController@index');

   Route::get('/home', 'HomeController@index');


/*facebook*/


Route::get('auth/facebook', 'Auth\AuthController@redirectToProvider');
Route::get('auth/facebook/callback', 'Auth\AuthController@handleProviderCallback');

    /*Route::get('/redirect', 'SocialAuthController@redirect');
    Route::get('/callback', 'SocialAuthController@callback');*/

    // Redirect to github to authenticate
    Route::get('github', 'SocialAuthController@github_redirect');
    // Get back to redirect url
    Route::get('account/github', 'SocialAuthController@github');








    Route::get('/home2', array('as' => 'home2', 'uses' => function(){
        return view('home2');
    }));

    Route::group(['prefix'=> '/forum'], function ()
    {

        Route::get('/',[
            'as' => 'forum-home', 'uses' =>'ForumController@index'
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
            Route::get('/thread/{id}/delete',[
                'as'=> 'forum-delete-thread', 'uses' => 'ForumController@deleteThread'
            ]);
            Route::get('/comment/{id}/delete',[
                'as'=> 'forum-delete-comment', 'uses' => 'ForumController@deleteComment'
            ]);
            Route::group(['before'=> 'csrf'], function ()
            {
                Route::post('/group', [
                    'as' => 'forum-store-group', 'uses' => "ForumController@storeGroup"
                ]);
                Route::post('/category/{id}/new',[
                    'as'=> 'forum-store-category', 'uses' => 'ForumController@storeCategory'
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
                Route::post('/comment/{id}/new', [
                    'as' => 'forum-store-comment', 'uses' => "ForumController@storeComment"
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