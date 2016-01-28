<?php namespace App\Http\Controllers\Profile;

use App\Http\Controllers\BaseController;
use App\API\Connectors\APIUser;

use Input, Redirect, Auth, Carbon, Validator, DB, App, Session;
use Illuminate\Support\MessageBag;

class ReferralController extends BaseController 
{
	protected $controller_name 				= 'referral';

	public function index($id = null)
	{		
		Session::set('API_token', Session::get('API_token_private'));

		$API_me 							= new APIUser;
		$me_detail 							= $API_me->getMeDetail([
													'user_id' 	=> $id,
												]);
		$data 								= $me_detail['data'];
		$page 								= view('web_v2.pages.profile.referral.index')
												->with('data', $data);
		return $page;

		// $this->layout->page 				= view('web.page.profile.referral.index');
		// $this->layout->breadcrumb				= $breadcrumb;
		// $this->layout->controller_name			= $this->controller_name;
		// $this->layout->page_title 				= 'BALIN.ID';
		// $this->layout->page_subtitle 			= 'Daftar Referral Anda';

		// return $this->layout->page;
	}
}