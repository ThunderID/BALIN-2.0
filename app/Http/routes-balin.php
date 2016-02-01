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
	Route::get('product',		 										['uses' => 'ProductController@index', 'as' => 'balin.product.index']);
	Route::get('product/detail/{slug?}',								['uses' => 'ProductController@show', 'as' => 'balin.product.show']);

/* 	------------------------------------------------------------------------------------
 	|  CART
	------------------------------------------------------------------------------------ */
	Route::get('cart',													['uses' => 'CartController@index', 'as' => 'balin.cart.index']);
	Route::any('cart/add/{slug?}',										['uses' => 'CartController@store', 'as' => 'balin.cart.store']);
	Route::any('cart/update/{slug?}/{varian_id?}',						['uses' => 'CartController@update', 'as' => 'balin.cart.update']);
	Route::get('cart/empty',											['uses' => 'CartController@clean', 'as' => 'balin.cart.empty']);
	// cart list in cart_dropdown 
	Route::any('cart/change/list/dropdown',								['uses'	=> 'CartController@getListBasket', 'as' => 'balin.cart.list']);

/* 	------------------------------------------------------------------------------------
 	|  CHECKOUT
	------------------------------------------------------------------------------------ */
	Route::get('checkout',												['uses' => 'CheckoutController@index', 'as' => 'balin.checkout.index']);
	Route::post('checkout',												['uses' => 'CheckoutController@store', 'as' => 'balin.checkout.store']);

	/*---=== check voucher with ajax ===---*/
	Route::any('check/voucher',											['uses' => 'CheckoutController@getCheckVoucher', 'as' => 'balin.checkout.voucher.check']);

	/*---=== get shippingcost with ajax ===---*/

	Route::any('shipping/cost',											['uses' => 'CheckoutController@getShippingCost', 'as' => 'balin.checkout.shippingcost.get']);
	/*---=== get address with ajax ===---*/
	Route::any('shipping/address/{id?}',								['uses' => 'CheckoutController@getAddress', 'as' => 'balin.checkout.shippingaddress.get']);
	
/* 	------------------------------------------------------------------------------------
 	|  SIGNUP & SIGNIN PAGE
	------------------------------------------------------------------------------------ */
	Route::post('do/signup',											['uses' => 'Profile\\UserController@store', 'as' => 'balin.dosignup']);

	/* LOGIN */
	Route::get('login', 												['uses' => 'LoginController@index', 'as' => 'balin.login.index']);
	Route::post('do/login',												['uses' => 'AuthController@doLogin', 'as' => 'balin.dologin']);

	// LOGOUT
	Route::get('dologout',												['uses' => 'AuthController@doLogout', 'as' => 'balin.dologout']);

	/* AKTIVASI LINK */
	Route::get('activation/link/{activation_link?}',						['uses' => 'AuthController@activation', 'as' => 'balin.activation']);

/* 	------------------------------------------------------------------------------------
	|  USER PROFILE
	------------------------------------------------------------------------------------ */
	Route::group(['prefix' => 'profile', 'namespace' => 'Profile\\'], function()
	{
		Route::get('/',													['uses' => 'UserController@index', 'as' => 'balin.profile.user.index']);

		// EDIT PROFILE USER [ VIEW TO MODAL ]
		Route::get('edit/{id?}', 										['uses' => 'UserController@edit', 'as' => 'balin.profile.user.edit']);
		Route::post('edit/{id?}', 										['uses' => 'UserController@update', 'as' => 'balin.profile.user.update']);

		// BALIN POINT
		Route::get('point/{id?}',										['uses' => 'PointController@index', 'as' => 'balin.profile.point.index']);

		// REFERENCE
		Route::get('reference', 										['uses' => 'ReferenceController@create', 'as' => 'balin.profile.reference.create']);
		Route::post('reference',										['uses' => 'ReferenceController@store', 'as' => 'balin.profile.reference.store']);

		// REFERRAL
		Route::get('referral/{id?}',									['uses' => 'ReferralController@index', 'as' => 'balin.profile.referral.index']);

		// ORDER
		Route::get('order/{id?}',										['uses'	=> 'OrderController@show', 'as' => 'balin.profile.order.show']);
	});

/* 	------------------------------------------------------------------------------------
	|  REFERRAL CODE & BALIN POINT
	------------------------------------------------------------------------------------ */
	// REFERRAL CODE
	Route::get('redeem/code',											['uses' => 'Profile\\RedeemController@index', 'as' => 'balin.redeem.index']);
	Route::post('redeem/code', 											['uses' => 'Profile\\RedeemController@store', 'as' => 'balin.redeem.store']);
});