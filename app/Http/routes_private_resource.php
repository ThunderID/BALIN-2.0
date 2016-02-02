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
	Route::any('checkout/shipping/cost',							['uses' => 'CheckoutController@shipping', 	'as' => 'balin.checkout.shippingcost.get']);

	/* Edit user profile [VIEW TO MODAL] */
	Route::get('edit/{id?}', 										['uses' => 'UserController@edit', 		'as' => 'balin.profile.user.edit']);
	Route::post('edit/{id?}', 										['uses' => 'UserController@update', 	'as' => 'balin.profile.user.update']);

	/* Display user Point [VIEW TO MODAL] */
	Route::get('point', 											['uses' => 'PointController@index', 'as' => 'balin.profile.point.index']);

	/* Display user referrence [VIEW TO MODAL] */
	Route::get('reference', 										['uses' => 'ReferenceController@create', 'as' => 'balin.profile.reference.create']);
	Route::post('reference',										['uses' => 'ReferenceController@store', 'as' => 'balin.profile.reference.store']);

	/* Display user referral [VIEW TO MODAL] */
	Route::get('referral/{id?}',									['uses' => 'ReferralController@index', 'as' => 'balin.profile.referral.index']);

	/* Display user referral [VIEW TO MODAL] */
	Route::get('order/detail/{id?}',								['uses' => 'OrderController@show', 'as' => 'balin.profile.order.show']);

});