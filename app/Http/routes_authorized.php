<?php

Route::group([env('ROUTE_BALIN_ATTRIBUTE') => env('ROUTE_BALIN_VALUE')], function() 
{
	/* Sign up page */
	Route::post('do/signup',											['uses' => 'Profile\\UserController@store', 'as' => 'balin.dosignup']);

	/* Login using SSO */
	Route::get('do/sso',												['uses' => 'AuthController@doSso', 'as' => 'balin.dosso']);
	Route::get('sso/success',											['uses' => 'AuthController@getSso', 'as' => 'balin.getsso']);

	/* Login using email */
	Route::get('login', 												['uses' => 'LoginController@index', 'as' => 'balin.login.index']);
	Route::post('do/login',												['uses' => 'AuthController@doLogin', 'as' => 'balin.dologin']);

	/* Logout */
	Route::get('dologout',												['uses' => 'AuthController@doLogout', 'as' => 'balin.dologout']);

	/* Account activation */
	Route::get('activation/link/{activation_link?}',					['uses' => 'AuthController@activation', 'as' => 'balin.activation']);
	
	/* Reset Password */
	Route::post('forgot/password',										['uses' => 'AuthController@forgot', 'as' => 'balin.forgot.password']);
	Route::get('reset/password/{link}',									['uses' => 'AuthController@reset', 'as' => 'balin.reset.password']);
	Route::post('change/password',										['uses' => 'AuthController@change', 'as' => 'balin.change.password']);

});
