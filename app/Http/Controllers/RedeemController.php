<?php namespace App\Http\Controllers;

use Input, Redirect, Auth, Carbon, Validator, DB, App;
use Illuminate\Support\MessageBag;

class RedeemController extends BaseController 
{
	protected $controller_name 					= 'redeem';

	public function index()
	{		
		$breadcrumb								= ['Redeem' => route('balin.redeem.index')];

		$this->layout->page 					= view('web_v2.pages.redeem_code.index');
		$this->layout->breadcrumb				= $breadcrumb;
		$this->layout->controller_name			= $this->controller_name;
		$this->layout->page_title 				= 'BALIN.ID';
		$this->layout->page_subtitle 			= 'Redeem Info';

		return $this->layout;
	}

	public function store()
	{
		dd(Input::all());
	}
}