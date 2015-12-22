<?php namespace App\Http\Controllers\Profile;

use Input, Redirect, Auth, Carbon, Validator, DB, App;
use Illuminate\Support\MessageBag;

class UserController extends BaseController 
{
	protected $controller_name 					= 'user';

	public function index()
	{		
		$breadcrumb								= ['Profile' => route('balin.profile.user.index')];

		$this->layout->page 					= view('web_v2.page.profile.user.index');
		$this->layout->breadcrumb 				= $breadcrumb;
		$this->layout->controller_name			= $this->controller_name;
		$this->layout->page->page_title 		= 'BALIN.ID';
		$this->layout->page->page_subtitle 		= 'Profile';

		return $this->layout;
	}

	public function edit()
	{		
		$breadcrumb									= ['Ubah Profile' => route('balin.profile.user.edit')];

		$this->layout->page 						= view('web_v2.page.profile.user.edit');
		$this->layout->page->page_subtitle 			= 'Ubah Pengaturan Akun';

		return  $this->layout->page;
	}

	public function update()
	{
		dd(Input::all());
	}
}