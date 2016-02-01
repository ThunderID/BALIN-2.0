<?php namespace App\Http\Controllers\Profile;

use App\API\Connectors\APIUser;
use App\Http\Controllers\BaseController;

use Illuminate\Support\MessageBag;
use Input, Redirect, Auth, Carbon, Validator, DB, App, Session;

class UserController extends BaseController 
{
	protected $controller_name 					= 'user';

	public function __construct()
	{
		parent::__construct();

		if (!Session::has('API_token_private'))
		{
			Redirect::route('balin.home.index');
		}

		Session::set('API_token', Session::get('API_token_private'));

		$this->page_attributes->title 				= 'Profile';
		$this->page_attributes->source 				= 'web_v2.pages.profile.user.';
		$this->page_attributes->breadcrumb			=	[
															'Profile' 	=> route('balin.profile.user.index'),
														];
	}

	public function index()
	{		
		$breadcrumb									= 	[
															'Profile' => route('balin.profile.user.index')
														];

		$API_me 									= new APIUser;

		/* get detail user */
		$me_detail 									= $API_me->getMeDetail([
															'user_id' 	=> Session::get('user_me')['id'],
														]);

		/* get order user not status cart */
		$me_orders									= $API_me->getMeOrder([
															'user_id'	=> Session::get('user_me')['id'],
															// 'take'		=> 5
														]);
		// dd($me_orders);
		/* parse date of birth in zero date to null */
		if ($me_detail['data']['date_of_birth'] <= '0000-00-00')
		{
			$me_detail['data']['date_of_birth']		= '';
		}

		$this->page_attributes->data				= 	[
															'me' 		=> $me_detail,
															'me_orders'	=> $me_orders,
														];

		$this->page_attributes->subtitle 			= 'Profile';
		$this->page_attributes->breadcrumb			= array_merge($this->page_attributes->breadcrumb, $breadcrumb);
		$this->page_attributes->source 				=  $this->page_attributes->source . 'index';

		return $this->generateView();
	}

	public function edit($id = null)
	{	
		$API_me										= new APIUser;
		$result										= $API_me->getMeDetail([
															'user_id'	=> $id,
														]);

		if ($result['data']['date_of_birth'] <= '0000-00-00')
		{
			$result['data']['date_of_birth']		= '';
		}

		$page 										= view('web_v2.pages.profile.user.edit')
														->with('data', $result['data']);
		return  $page;
	}

	public function update($id = null)
	{
		$data['user_id']					= $id;
		$data['id']							= $id;
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
		if (Input::has('password') || is_null($id))
		{
			$validator 						= Validator::make(Input::only('password', 'password_confirmation'), ['password' => 'required|min:8|confirmed']);

			if (!$validator->passes())
			{
				return Redirect::route('balin.profile.user.index')
						->withInput()
						->withErrors($validator->errors())
						->with('msg-type', 'danger');
			}
			else 
			{
				$data['password']			= Input::get('password');	
			}
		}

		Session::set('API_token', Session::get('API_token_private'));
// dd($data);
		$API_me 							= new APIUser;
		$result								= $API_me->postDataUpdate($data);	

		if ($result['status'] != 'success')
		{
			$error 				= $result['message'];
		}
	}

	public function store($id = "")
	{
		if (preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]))
		{
			$dob						= Carbon::createFromFormat('Y-m-d', Input::get('date_of_birth'))->format('Y-m-d H:i:s');
		}
		else
		{
			$dob						= Carbon::createFromFormat('d-m-Y', Input::get('date_of_birth'))->format('Y-m-d H:i:s');
		}
		
		$data 							=	[
												'id'			=> $id,
												'name' 			=> Input::get('name'),
												'email'			=> Input::get('email'),
												'password'		=> Input::get('password'),
												'date_of_birth'	=> $dob,
												'gender'		=> Input::get('gender'),
												'role'			=> 'customer'
											];
		
		if (Input::has('password') || is_null($id))
		{
			$validator 					= Validator::make(Input::only('password', 'password_confirmation'), ['password' => 'required|min:8|confirmed']);

			if (!$validator->passes())
			{
				return Redirect::route('balin.login.index')
						->withInput()
						->withErrors($validator->errors())
						->with('msg-type', 'danger')
						->with('msg-from', 'signup');
			}
		}

		Session::set('API_token', Session::get('API_token_public'));

		// API User
		$API_user 						= new APIUser;
		$result							= $API_user->postDataSignUp($data);

		$errors 	 					= new MessageBag();

		if ($result['status'] != 'success')
		{
			$errors 					= $result['message'];
		}

		if (count($errors) == 0)
		{
			return Redirect::route('balin.login.index')
					->with('msg', 'Terima kasih sudah mendaftar, Balin telah mengirimkan hadiah selamat datang untuk Anda melalui email Anda')
					->with('msg-type', 'success')
					->with('msg-from', 'signup');
		}
		else
		{
			return Redirect::route('balin.login.index')
					->withInput(Input::all())
					->withErrors($errors)
					->with('msg-type', 'danger')
					->with('msg-from', 'signup');
		}
	}
}