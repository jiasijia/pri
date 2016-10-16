<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::group(['namespace' => 'Auth', 'prefix' => 'auth'], function()
{
    // Authentication routes...
    Route::get('login', ['uses' => 'AuthController@getLogin', 'as' => 'authAuthGetLogin']);
    Route::post('login', ['uses' => 'AuthController@postLogin', 'as' => 'authAuthPostLogin']);
    Route::get('logout', ['uses' => 'AuthController@getLogout', 'as' => 'authAuthGetLogout']);
});

Route::group(['namespace' => 'Home'], function() {
	
	Route::get('/', ['uses' => 'IndexController@index', 'as'=> 'homeIndex']);
	Route::get('/martrix', ['uses' => 'MartrixController@index', 'as'=> 'homeMartrix']);
	Route::get('/album', ['uses' => 'AlbumController@index', 'as'=> 'homeAlbum']);
	
});
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {
	
	Route::get('/', ['uses' => 'IndexController@home', 'as'=> 'adminHome']);
	Route::get('/index', ['uses' => 'IndexController@index', 'as'=> 'adminIndex']);

	
});
