<?php namespace App\Http\Controllers;

use Route;

abstract class BaseController extends Controller
{
	protected $layout;
	protected $stores;

	public function __construct() 
	{
		if (Route::is('balin.campaign.join.get'))
		{
			$this->layout = view('web_v2.page_templates.layout_campaign');
		}
		else
		{
			$this->layout = view('web_v2.page_templates.layout');
		}
	}

}
