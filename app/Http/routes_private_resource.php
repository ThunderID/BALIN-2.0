<?php 

Route::group([env('ROUTE_BALIN_ATTRIBUTE') => env('ROUTE_BALIN_VALUE'), 'prefix' => 'me', 'namespace' => 'Me\\', 'middleware' => 'auth.me'], function() 
{
	/* User profile */
	Route::get('/',													['uses' => 'UserController@index', 			'as' => 'my.balin.profile']);
	Route::get('edit', 												['uses' => 'UserController@edit', 			'as' => 'my.balin.profile.edit']);
	Route::post('edit', 											['uses' => 'UserController@update', 		'as' => 'my.balin.profile.update']);
	Route::get('point', 											['uses' => 'UserController@points', 		'as' => 'my.balin.profile.point']);
	Route::get('referral',											['uses' => 'UserController@referrals', 		'as' => 'my.balin.profile.referral']);
	Route::get('order',												['uses' => 'UserController@orders', 		'as' => 'my.balin.profile.order']);

	/* page user redeem code */
	Route::get('redeem',											['uses' => 'RedeemController@index', 		'as' => 'my.balin.redeem.index']);
	Route::get('redeem/create',										['uses' => 'RedeemController@create', 		'as' => 'my.balin.redeem.create']);
	Route::post('redeem/store', 									['uses' => 'RedeemController@store', 		'as' => 'my.balin.redeem.store']);

	/* Checkout info */
	Route::get('checkout',											['uses' => 'CheckoutController@get', 		'as' => 'my.balin.checkout.get']);
	Route::post('checkout',											['uses' => 'CheckoutController@post', 		'as' => 'my.balin.checkout.post']);
	Route::any('checkout/voucher',									['uses' => 'CheckoutController@voucher', 	'as' => 'my.balin.checkout.voucher']);
	Route::any('checkout/shipping/cost',							['uses' => 'CheckoutController@shipping', 	'as' => 'my.balin.checkout.shippingcost']);

	/* Order info */
	Route::get('order/{id}',										['uses' => 'OrderController@show', 			'as' => 'my.balin.order.show']);
	Route::get('order/cancel/{id}',									['uses' => 'OrderController@destroy', 		'as' => 'my.balin.order.destroy']);
});