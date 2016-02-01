<?php namespace App\Http\Controllers\Me;

use App\API\Connectors\APIUser;

use App\Http\Controllers\BaseController;

use Input, Redirect, Session;

use Illuminate\Support\MessageBag;

/**
 * Used for Redeem Controller
 * 
 * @author agil
 */
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
															'Redeem Code' 	=> route('my.balin.redeem.index'),
														];
	}

	/**
	 * function to generate view redeem point for balin
	 *
	 * @return view
	 */
	public function index()
	{		
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

	/**
	 * function to modal show input redeem point for user
	 *
	 *
	 */
	public function create()
	{											
		$page 										= view('web_v2.pages.profile.redeem.create');

		return $page;
	}
	
	/**
	 * function to store redeem point for user
	 *
	 * @param referral_code
	 */
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
		$result										= $API_me->postMeRedeemCode($data);

		if ($result['status'] != 'success')
		{
			$this->errors							= $result['message'];
		}
		else
		{
			$this->page_attributes->success 		= 'Selamat anda poin Anda menjadi '.$result['data']['total_point'];
		}

		return $this->generateRedirectRoute($to);
	}
}