<?php

Route::group(['prefix' => 'cms', 'namespace' => 'Backend\\'], function()
{
	Route::any('dashboard',										['uses' => 'DashboardController@index', 'as' => 'admin.home.dashboard']);

	// ------------------------------------------------------------------------------------
	// Barang
	// ------------------------------------------------------------------------------------
	Route::resource('produk',  	'ProductController',			['names' => ['index' => 'admin.data.product.index', 'create' => 'admin.data.product.create', 'store' => 'admin.data.product.store', 'show' => 'admin.data.product.show', 'edit' => 'admin.data.product.edit', 'update' => 'admin.data.product.update', 'destroy' => 'admin.data.product.destroy']]);
	Route::resource('stok',  	'StockController',				['names' => ['index' => 'admin.data.stock.index', 'create' => 'admin.data.stock.create', 'store' => 'admin.data.stock.store', 'show' => 'admin.data.stock.show', 'edit' => 'admin.data.stock.edit', 'update' => 'admin.data.stock.update', 'destroy' => 'admin.data.stock.destroy']]);

});