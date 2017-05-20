<?php

use Illuminate\Http\Request;

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

Route::group(['middleware'=>'api'],function(){
	Route::post('auth/signup','Api\AuthController@signUp');
	Route::post('auth/signin','Api\AuthController@signIn');


	/**
	 *
	 * you must have token for access this route
	 *
	 */
	Route::group(['middleware'=>'jwt.auth'],function(){
		Route::get('/profile','Api\UserController@profile');
		/**
		 *
		 * CATEGORY MODULE API
		 *
		 */
		
		Route::get('/category','Api\CategoryController@index');
		Route::get('/category/{id}','Api\CategoryController@show');
		Route::post('/category/store','Api\CategoryController@store');
		Route::put('/category/update/{id}','Api\CategoryController@update');
		Route::delete('/category/delete/{id}','Api\CategoryController@delete');


	});	
	
});