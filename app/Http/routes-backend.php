<?php

Route::group(['prefix' => 'cms', 'namespace' => 'Backend\\'], function()
{
	Route::any('dashboard',								['uses' => 'DashboardController@index', 'as' => 'backend.index']);
});