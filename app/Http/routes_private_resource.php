<?php 

Route::group([env('ROUTE_BALIN_ATTRIBUTE') => env('ROUTE_BALIN_VALUE')], function() 
{
	/* Checkout info */
	Route::get('checkout',												['uses' => 'CheckoutController@index', 'as' => 'balin.checkout.index']);
	Route::post('checkout',												['uses' => 'CheckoutController@store', 'as' => 'balin.checkout.store']);

	/* Ajax checkout voucher */
	Route::any('check/voucher',											['uses' => 'CheckoutController@getCheckVoucher', 'as' => 'balin.checkout.voucher.check']);
	/* Ajax checkout shipping cost */
	Route::any('shipping/cost',											['uses' => 'CheckoutController@getShippingCost', 'as' => 'balin.checkout.shippingcost.get']);
	/* Ajax checkout addresses */
	Route::any('shipping/address/{id?}',								['uses' => 'CheckoutController@getAddress', 'as' => 'balin.checkout.shippingaddress.get']);
	
	/* User profile */
	Route::group(['prefix' => 'profile', 'namespace' => 'Profile\\'], function()
	{
		Route::get('/',													['uses' => 'UserController@index', 'as' => 'balin.profile.user.index']);

		/* Edit user profile [VIEW TO MODAL] */
		Route::get('edit/{id?}', 										['uses' => 'UserController@edit', 'as' => 'balin.profile.user.edit']);
		Route::post('edit/{id?}', 										['uses' => 'UserController@update', 'as' => 'balin.profile.user.update']);

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

	/* page user redeem code */
	Route::get('redeem/code',											['uses' => 'Profile\\RedeemController@index', 'as' => 'balin.redeem.index']);

	/* Update user redeem code [VIEW TO MODAL] */
	Route::get('redeem/code/check',										['uses' => 'Profile\\RedeemController@create', 'as' => 'balin.redeem.create']);

	/* Post redeem code */
	Route::post('redeem/code', 											['uses' => 'Profile\\RedeemController@store', 'as' => 'balin.redeem.store']);
});