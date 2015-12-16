<?php namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller as Controllers;
// use App\Models\StoreSetting;

abstract class Controller extends Controllers
{
	protected $layout;
	protected $stores;

	public function __construct() 
	{
		// $store 								= StoreSetting::storeinfo(true)->get();

		// $stores 							= null;
		// foreach ($store as $key => $value) 
		// {
		// 	$stores[$value->type] 			= $value->value;
		// }

		// view()->share('storeinfo', $stores);

		$this->layout = view('web.page_templates.layout');
	}

}
