<?php namespace App\Http\Controllers\Web\Profile;

use App\Http\Controllers\Web\Controller;

use Input, Redirect, Auth, Carbon, Validator, DB, App;
use Illuminate\Support\MessageBag;

class ReferralController extends Controller 
{
	protected $controller_name 					= 'referral';

	public function index()
	{		
		$breadcrumb								= ['Balin Point' => route('balin.profile.referral.index')];

		$this->layout->page 					= view('web.page.profile.referral.index');
		$this->layout->breadcrumb				= $breadcrumb;
		$this->layout->controller_name			= $this->controller_name;
		$this->layout->page_title 				= 'BALIN.ID';
		$this->layout->page_subtitle 			= 'Daftar Referral Anda';

		return $this->layout->page;
	}
}