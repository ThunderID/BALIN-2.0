<?php

Route::group(['prefix' => 'cms', 'namespace' => 'Backend\\'], function()
{
	Route::any('dashboard',										['uses' => 'DashboardController@index', 'as' => 'admin.dashboard']);

	// ------------------------------------------------------------------------------------
	// Barang
	// ------------------------------------------------------------------------------------
	Route::resource('produk',  	'ProductController',			['names' => ['index' => 'admin.product.index', 'create' => 'admin.product.create', 'store' => 'admin.product.store', 'show' => 'admin.product.show', 'edit' => 'admin.product.edit', 'update' => 'admin.product.update', 'destroy' => 'admin.product.destroy']]);
	Route::resource('stok',  	'StockController',				['names' => ['index' => 'admin.stock.index', 'create' => 'admin.stock.create', 'store' => 'admin.stock.store', 'show' => 'admin.stock.show', 'edit' => 'admin.stock.edit', 'update' => 'admin.stock.update', 'destroy' => 'admin.stock.destroy']]);
	Route::resource('supplier', 'SupplierController',			['names' => ['index' => 'admin.supplier.index', 'create' => 'admin.supplier.create', 'store' => 'admin.supplier.store', 'show' => 'admin.supplier.show', 'edit' => 'admin.supplier.edit', 'update' => 'admin.supplier.update', 'destroy' => 'admin.supplier.destroy']]);

});