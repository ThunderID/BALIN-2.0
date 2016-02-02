<?php namespace App\Http\Controllers\Me;

use App\API\Connectors\APIUser;

use App\Http\Controllers\BaseController;

use Illuminate\Support\MessageBag;

use Input, Redirect, Carbon, Validator, Session;

/**
 * Used for User Controller
 * 
 * @author agil
 */
class UserController extends BaseController 
{
	protected $controller_name 					= 'user';

	public function __construct()
	{
		parent::__construct();

		Session::set('API_token', Session::get('API_token_private'));

		$this->page_attributes->title 				= 'BALIN.ID';
		$this->page_attributes->source 				= 'web_v2.pages.profile.user.';
		$this->page_attributes->breadcrumb			=	[
															'Profile' 	=> route('my.balin.profile'),
														];
	}

	/**
	 * function to get my profile
	 * 
	 * 1. Get My detail information
	 * 2. Generate breadcrumb
	 * 3. Generate view
	 * @return view
	 */
	public function index()
	{
		//1. Get My detail information
		$APIUser 									= new APIUser;

		$whoami 									= $APIUser->getMeDetail(['user_id' 	=> Session::get('whoami')['id']]);

		//temporary order
		$me_orders									= $APIUser->getMeOrder(['user_id'	=> Session::get('whoami')['id']]);

		//parse date of birth
		if ($whoami['data']['date_of_birth'] <= '0000-00-00')
		{
			$whoami['data']['date_of_birth']		= '';
		}

		//2. Generate breadcrumb
		$breadcrumb									= 	[
															'Profile' => route('my.balin.profile')
														];

		$this->page_attributes->breadcrumb			= array_merge($this->page_attributes->breadcrumb, $breadcrumb);


		//3. Generate view
		$this->page_attributes->data				= 	[
															'me' 		=> $whoami,
															'me_orders'	=> $me_orders,
														];
		$this->page_attributes->subtitle 			= 'Profile';
		$this->page_attributes->source 				=  $this->page_attributes->source . 'index';

		return $this->generateView();
	}

	/**
	 * function to display edit form
	 * 
	 * 1. Get My detail information
	 * 2. Generate view
	 * @return view
	 */
	public function edit()
	{
		//1. Get My detail information
		$APIUser									= new APIUser;

		$result										= $APIUser->getMeDetail(['user_id'	=> Session::get('whoami')['id']]);

		if ($result['data']['date_of_birth'] <= '0000-00-00')
		{
			$result['data']['date_of_birth']		= '';
		}

		//2. Generate view
		$page 										= view('web_v2.pages.profile.user.edit')->with('data', $result['data']);

		return  $page;
	}

	/**
	 * function to store my profile updates
	 * 
	 * 1. Parsing variable
	 * 2. Get My detail information
	 * 3. Check result
	 * @return redirected url
	 */
	public function update()
	{
		//1. Parsing variable
		$data['user_id']					= Session::get('whoami')['id'];
		$data['id']							= Session::get('whoami')['id'];
		$data['name']						= Input::get('name');
		$data['email']						= Input::get('email');
		$data['gender']						= Input::get('gender');
		
		/* Get input date of birth */
		if (preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]))
		{
			$data['date_of_birth']			= Carbon::createFromFormat('d-m-Y', Input::get('date_of_birth'))->format('Y-m-d H:i:s');
		}
		else
		{
			$data['date_of_birth']			= Carbon::createFromFormat('d-m-Y', Input::get('date_of_birth'))->format('Y-m-d H:i:s');
		}

		/* check if set password */
		if (Input::has('password') || is_null(Session::get('whoami')['id']))
		{
			$validator 						= Validator::make(Input::only('password', 'password_confirmation'), ['password' => 'required|min:8|confirmed']);

			if (!$validator->passes())
			{
				$this->error 				= $validator->errors();
			}
			else 
			{
				$data['password']			= Input::get('password');	
			}
		}

		//2. Get My detail information
		$APIUser 							= new APIUser;
		$result								= $APIUser->postDataUpdate($data);	

		//3. Check result
		if ($result['status'] != 'success')
		{
			$this->errors 					= $result['message'];
		}

		$this->page_attributes->success 	= "Profil sudah tersimpan";

		return $this->generateRedirectRoute('my.balin.profile');	
	}

	/**
	 * function to get summary of my points
	 * 
	 * 1. Get My detail information
	 * 2. Get My point
	 * 3. Generate view
	 * @return view
	 */
	public function points()
	{		
		//1. Get My detail information
		$APIUser 							= new APIUser;
		
		$whoami 							= $APIUser->getMeDetail(['user_id'	=> Session::get('whoami')['id']]);

		//2. Get My point
		$me_point 							= $APIUser->getMePoint(['user_id' 	=> Session::get('whoami')['id']]);

		//3. Generate view
		$data 								= 	[
													'point'	=> $me_point['data'],
													'me'	=> $whoami['data'],
												];
												
		$page 								= view('web_v2.pages.profile.point.index')->with('data', $data);
		return $page;
	}

	/**
	 * function to get all of my referrals
	 * 
	 * 1. Get My detail information
	 * 2. Generate view
	 * @return view
	 */
	public function referrals()
	{
		//1. Get My detail information	
		$APIUser 							= new APIUser;
		$whoami 							= $APIUser->getMeDetail(['user_id'	=> Session::get('whoami')['id']]);

		//2. Generate view
		$data 								= $whoami['data'];
		$page 								= view('web_v2.pages.profile.referral.index')->with('data', $data);
		return $page;
	}

	/**
	 * function to get all of my orders
	 * 
	 * 1. Get My orders
	 * 2. Generate view
	 * @return view
	 */
	public function orders()
	{
		//1. Get My orders
		$APIUser 							= new APIUser;
		$me_orders							= $APIUser->getMeOrder(['user_id'	=> Session::get('whoami')['id']]);
		
		//2. Generate view
		$data 								= $me_orders['data'];
		$page 								= view('web_v2.pages.profile.order.index')->with('data', $data);
		return $page;
	}
}