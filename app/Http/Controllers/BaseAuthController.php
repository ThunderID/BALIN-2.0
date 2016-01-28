<?php namespace App\Http\Controllers;

use App\API\API;
use App\API\Connectors\APIProduct;
use Route, Session, Cache, Redirect;

abstract class BaseAuthController extends Controller
{
	protected $layout;
	protected $stores;
	protected $recommend;

	public function __construct() 
	{
		if (Session::has('user_me'))
		{
			Session::set('API_token', Session::get('API_token_authenticated'));
		}
		else
		{
			Redirect::route('balin.home.index');
		}
		
		$recommend 							= Cache::remember('recommended_batik', 30, function() 
		{
			$API_product 					= new APIProduct;

			return $API_product->getIndex([]);
		});

		$this->recommend 					= $recommend;


		if (Route::is('balin.campaign.join.get'))
		{
			$this->layout 				= view('web_v2.page_templates.layout_campaign');
		}
		else
		{
			$this->layout 					= view('web_v2.page_templates.layout')
												->with('recommend', $this->recommend);
		}
	}
}
