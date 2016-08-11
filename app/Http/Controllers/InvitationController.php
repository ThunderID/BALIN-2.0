<?php namespace App\Http\Controllers;

use App\API\API;

use App\API\Connectors\APIUser;
use App\API\Connectors\APIConfig;
use App\API\Connectors\APISendMail;

use Input, Session, Redirect, Socialite, Validator, Carbon, BalinMail;

use Illuminate\Support\MessageBag as MessageBag;

/**
 * Used for Invitation Controller
 * 
 * @author agil
 */
class InvitationController extends BaseController 
{
	protected $controller_name 						= 'Invitation';

	public function __construct()
	{
		parent::__construct();

		$this->page_attributes->title 				= 'BALIN.ID';
	}

	/**
	 * function to sign up by invitation
	 *
	 * @param object view
	 */
	public function get($code = "")
	{
		if (Session::has('whoami'))
		{
			return Redirect::route('my.balin.redeem.index');
		}

		$breadcrumb									= ['Sign Up' => route('balin.get.login')];

		$this->page_attributes->subtitle 			= 'Sign Up';
		$this->page_attributes->breadcrumb			= $breadcrumb;
		$this->page_attributes->source 				= 'web_v2.pages.login.index';
		$this->page_attributes->type_form			= 'signup';
		$this->page_attributes->data 				= ['code' => $code];

		return $this->generateView();
	}

	/**
	 * function to sign up by invitation
	 *
	 * @param object view
	 */
	public function post($code = "")
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
												'id'			=> '',
												'name' 			=> Input::get('name'),
												'email'			=> Input::get('email'),
												'password'		=> Input::get('password'),
												'date_of_birth'	=> $dob,
												'gender'		=> Input::get('gender'),
												'role'			=> 'customer',
												'reference_code'=> $code,
											];
		
		if (Input::has('password'))
		{
			$validator 					= Validator::make(Input::only('password', 'password_confirmation'), ['password' => 'required|min:8|confirmed']);

			if (!$validator->passes())
			{
				$this->errors			= $validator->errors();
				$type 					= 'signup';
			}
		}

		Session::set('API_token', Session::get('API_token_public'));

		// API User
		$API_user 						= new APIUser;
		$user							= $API_user->postDataSignUp($data);

		if ($user['status'] != 'success')
		{
			$this->errors 				= $user['message'];
			$type 						= 'signup';
		}
		else
		{
			$infos 								= [];
			foreach ($this->balin['info'] as $key => $value) 
			{
				$infos[$value['type']]			= $value['value'];
			}

			$infos['action']					= route(env('ROUTE_BALIN_CLAIM_VOUCHER'), $user['data']['activation_link']);
			
			$mail 								= new APISendMail;
			$result								= $mail->welcomemail($user['data'], $infos);
			
			if (isset($result['message']))
			{
				$this->errors					= $result['message'];
				$type 							= 'signup';
			}

			$type 						= 'login';
		}

		$this->page_attributes->success 		= "Terima kasih sudah mendaftar, Balin telah mengirimkan hadiah selamat datang untuk Anda melalui email Anda.";

		return $this->generateRedirectRoute('balin.get.login', ['type' => $type]);
	}
}	