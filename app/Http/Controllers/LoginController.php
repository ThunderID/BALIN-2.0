<?php namespace App\Http\Controllers;

use Input, Redirect, Auth, Carbon, Validator, DB, App, Session;
use Illuminate\Support\MessageBag;

class LoginController extends BaseController 
{
	protected $controller_name 							= 'login';

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{	
		if (Session::has('user_me'))
		{
			return Redirect::route('balin.redeem.index');
		}

		$breadcrumb										= ['Sign In' => route('balin.login.index')];
		$this->layout->page 							= view('web_v2.pages.login.index')
															->with('controller_name', $this->controller_name)
															->with('breadcrumb', $breadcrumb);

		$this->layout->controller_name					= $this->controller_name;

		$this->layout->page->page_title 				= 'BALIN.ID';
		$this->layout->page->page_subtitle 				= 'Sign In';

		return $this->layout;
	}
}