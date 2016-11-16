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

Auth::routes();

Route::group(['prefix' => 'user'], function() {
	Route::group(['middleware' => 'guest'], function() {
		Route::post('/signup', [
			'uses' => 'UserController@postSignUp',
			'as'   => 'signup'
		]);
		Route::post('/signin', [
			'uses' => 'UserController@postSignIn',
			'as'   => 'signin'
		]);
	});
	Route::group(['middleware' => 'auth'], function() {
		Route::get('/logout', [
			'uses' => 'UserController@getLogout',
			'as'   => 'logout'
		]);
	});
});

Route::group(['middleware' => 'auth'], function() {
	Route::get('/', [
		'uses' => 'PostController@getIndex',
		'as'   => 'index',
	]);
	Route::post('/', [
		'uses' => 'PostController@postIndex',
		'as'   => 'index',
	]);
	Route::group(['prefix' => 'post'], function() {
		Route::post('create', [
			'uses' => 'PostController@postCreate',
			'as'   => 'post.create',
		]);
		Route::post('edit/{id}', [
			'uses' => 'PostController@postEdit',
			'as'   => 'post.edit',
		]);
		Route::get('delete/{id}', [
			'uses' => 'PostController@getDelete',
			'as'   => 'post.delete',
		]);
	});
});

Route::get('/login', [
	'uses' => 'UserController@getLogin',
	'as'   => 'login',
]);
