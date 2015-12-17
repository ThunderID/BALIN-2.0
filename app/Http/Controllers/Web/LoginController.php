<?php namespace App\Http\Controllers\Web;

use Input, Redirect, Auth, Carbon, Validator, DB, App;
use Illuminate\Support\MessageBag;

// use App\Models\User;
// use App\Models\PointLog;

class LoginController extends Controller 
{
	protected $controller_name 							= 'login';

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{	
		if (Auth::check())
		{
			// return Redirect::route('frontend.user.index');
		}

		$breadcrumb										= ['Sign In' => route('balin.login.index')];
		$this->layout->page 							= view('web.page.login.index')
															->with('controller_name', $this->controller_name)
															->with('breadcrumb', $breadcrumb);

		$this->layout->controller_name					= $this->controller_name;

		$this->layout->page->page_title 				= 'BALIN.ID';
		$this->layout->page->page_subtitle 				= 'Sign In';

		return $this->layout;
	}
}