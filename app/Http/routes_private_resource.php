<?php 

Route::group([env('ROUTE_BALIN_ATTRIBUTE') => env('ROUTE_BALIN_VALUE'), 'prefix' => 'profile', 'namespace' => 'Me\\', 'middleware' => 'auth.me'], function() 
{
	/* User profile */
	Route::get('/',													['uses' => 'UserController@index', 			'as' => 'balin.profile.user.index']);

	/* page user redeem code */
	Route::get('redeem/code',										['uses' => 'RedeemController@index', 		'as' => 'my.balin.redeem.index']);
	Route::get('redeem/code/check',									['uses' => 'RedeemController@create', 		'as' => 'my.balin.redeem.create']);
	Route::post('redeem/code', 										['uses' => 'RedeemController@store', 		'as' => 'my.balin.redeem.store']);

	/* Checkout info */
	Route::get('checkout',											['uses' => 'CheckoutController@get', 		'as' => 'my.balin.checkout.get']);
	Route::post('checkout',											['uses' => 'CheckoutController@post', 		'as' => 'my.balin.checkout.post']);
	Route::any('checkout/voucher',									['uses' => 'CheckoutController@voucher', 	'as' => 'my.balin.checkout.voucher']);
	Route::any('checkout/shipping/cost',							['uses' => 'CheckoutController@shipping', 	'as' => 'my.balin.checkout.shippingcost']);

	/* Order info */
	Route::get('order/{id?}',										['uses' => 'OrderController@show', 			'as' => 'my.balin.order.show']);
	Route::get('order/cancel/{id}',									['uses' => 'OrderController@destroy', 		'as' => 'my.balin.order.destroy']);
	
	/* Edit user profile [VIEW TO MODAL] */
	Route::get('edit/{id?}', 										['uses' => 'UserController@edit', 			'as' => 'my.balin.profile.edit']);
	Route::post('edit/{id?}', 										['uses' => 'UserController@update', 		'as' => 'my.balin.profile.update']);

	/* Display user Point [VIEW TO MODAL] */
	Route::get('point', 											['uses' => 'UserController@points', 		'as' => 'my.balin.profile.point']);

	/* Display user referral [VIEW TO MODAL] */
	Route::get('referral/{id?}',									['uses' => 'UserController@referrals', 		'as' => 'my.balin.profile.referral']);

});