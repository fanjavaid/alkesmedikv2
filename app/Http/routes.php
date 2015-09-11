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

Route::get('/', function () {
    return view('welcome');
});

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Route::get('admin', function() {
// 	return view('welcome');
// });

Route::group(array('namespace' => 'Admin'), function() {
	Route::resource('am-admin/category', 'CategoryController');

	Route::resource('am-admin/post', 'PostController');
	Route::get('am-admin/post/removeImage/{imageName}', ['as' => 'post.removeImage', 'uses' => 'PostController@removeImage']);

	Route::resource('am-admin/media', 'MediaController');

	Route::resource('am-admin/page', 'PageController');
	Route::get('am-admin/page/removeImage/{imageName}', ['as' => 'page.removeImage', 'uses' => 'PageController@removeImage']);

	Route::resource('am-admin/attribute', 'AttributeController');
	Route::resource('am-admin/product', 'ProductController');
});