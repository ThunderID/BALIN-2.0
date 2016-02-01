<?php namespace App\Http\Controllers\Profile;

use App\API\Connectors\APIUser;
use App\Http\Controllers\BaseController;

use Input, Redirect, Auth, Carbon, Validator, DB, App, Session;
use Illuminate\Support\MessageBag;

class RedeemController extends BaseController 
{
	protected $controller_name 						= 'redeem';

	public function __construct()
	{
		parent::__construct();
		Session::set('API_token', Session::get('API_token_private'));

		$this->page_attributes->title 				= 'Redeem Code';
		$this->page_attributes->source 				= 'web_v2.pages.redeem_code.';
		$this->page_attributes->breadcrumb			=	[
															'Redeem Code' 	=> route('balin.redeem.index'),
														];
	}

	public function index()
	{		
		/* get detail user logged */
		$API_me 									= new APIUser;
		$me_detail 									= $API_me->getMeDetail([
															'user_id' 	=> Session::get('user_me')['id'],
														]);

		$this->page_attributes->data				= 	[
															'me' 		=> $me_detail,
														];

		$this->page_attributes->subtitle 			= 'Redeem Code';
		$this->page_attributes->breadcrumb			= array_merge($this->page_attributes->breadcrumb);
		$this->page_attributes->source 				=  $this->page_attributes->source . 'index';

		return $this->generateView();
	}

	public function create()
	{											
		$page 										= view('web_v2.pages.profile.redeem.create');

		return $page;
	}

	public function store()
	{
		/* get for redirect route to */
		$to 										= Input::get('to');

		/* array parameter to API */
		$data										= 	[
															'user_id'	=> Session::get('user_me')['id'],
															'code'		=> Input::get('referral_code'),
														];

		$API_me 									= new APIUser;

		/* parsing data to API */
		$result										= $API_me->postMeRedeemCode($data);

		if ($result['status'] != "success")
		{
			$this->errors							= $result['message'];
		}

		$this->page_attributes->success 		= "Selamat anda mendapatkan point";

		//return view and routw
		return $this->generateRedirectRoute($to);
	}
}