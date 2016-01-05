<?php 

Route::group([env('ROUTE_BALIN_ATTRIBUTE') => env('ROUTE_BALIN_VALUE')], function() 
{
/* 	------------------------------------------------------------------------------------
 	|  HOME
	------------------------------------------------------------------------------------ */
	Route::get('/', 													['uses' => 'HomeController@index', 'as' => 'balin.home.index']);

/* 	------------------------------------------------------------------------------------
 	|  PRODUCT
	------------------------------------------------------------------------------------ */
	Route::get('product/{page?}', 										['uses' => 'ProductController@index', 'as' => 'balin.product.index']);
	Route::get('product/detail/{slug?}',								['uses' => 'ProductController@show', 'as' => 'balin.product.show']);

/* 	------------------------------------------------------------------------------------
 	|  SIGNUP & SIGNIN PAGE
	------------------------------------------------------------------------------------ */
	Route::get('login', 												['uses' => 'LoginController@index', 'as' => 'balin.login.index']);
	Route::post('do/login',												['uses' => 'AuthController@doLogin', 'as' => 'balin.dologin']);

/* 	------------------------------------------------------------------------------------
	|  USER PROFILE
	------------------------------------------------------------------------------------ */
	Route::group(['prefix' => 'profile', 'namespace' => 'Profile\\'], function()
	{
		Route::get('/',													['uses' => 'UserController@index', 'as' => 'balin.profile.user.index']);

		// EDIT PROFILE USER [ VIEW TO MODAL ]
		Route::get('edit', 												['uses' => 'UserController@edit', 'as' => 'balin.profile.user.edit']);
		Route::post('edit', 											['uses' => 'UserController@update', 'as' => 'balin.profile.user.update']);

		// BALIN POINT
		Route::get('point', 											['uses' => 'PointController@index', 'as' => 'balin.profile.point.index']);

		// REFERENCE
		Route::get('reference', 										['uses' => 'ReferenceController@create', 'as' => 'balin.profile.reference.create']);
		Route::post('reference',										['uses' => 'ReferenceController@store', 'as' => 'balin.profile.reference.store']);

		// REFERRAL
		Route::get('referral',											['uses' => 'ReferralController@index', 'as' => 'balin.profile.referral.index']);
	});

/* 	------------------------------------------------------------------------------------
	|  REFERRAL CODE & BALIN POINT
	------------------------------------------------------------------------------------ */
	// REFERRAL CODE
	Route::get('redeem/code',											['uses' => 'RedeemController@index', 'as' => 'balin.redeem.index']);
	Route::post('redeem/code', 											['uses' => 'RedeemController@store', 'as' => 'balin.redeem.store']);
});