<?php namespace App\Http\Controllers;

use App\API\API;

use App\API\Connectors\APIUser;

use Input, Session, Redirect, Auth, Socialite, Validator, App;

/**
 * Used for Password Controller
 * 
 * @author cmooy
 */
class PasswordController extends BaseController 
{
	protected $controller_name 				= 'Login';

	public function __construct()
	{
		parent::__construct();

		Session::set('API_token', Session::get('API_token_private'));
		
		$this->page_attributes->title 		= 'Balin.id';
	}

	/**
	 * function to get forgot link
	 *
	 * @param email
	 */
	public function forgot()
	{
		$breadcrumb										= 	[
																'Lupa Password' => ''
															];

		$email 											= Input::Get('email');
		
		/* set api token use token public */
		Session::set('API_token', Session::get('API_token_public'));

		$API_me 										= new APIUser;
		$result 										= $API_me->postForgot([
																'email'	=> $email,
															]);
		if ($result['status'] != 'success')
		{
			return Redirect::route('balin.home.index')->withErrors($result['message'])->with('msg-type', 'danger');
		}
		else
		{
			$this->page_attributes->data 				= 	[
																'me'	=> $result['data'],
															];

			$this->page_attributes->subtitle 			= 'Lupa Password';
			$this->page_attributes->breadcrumb			= array_merge($breadcrumb);
			$this->page_attributes->source 				= 'web_v2.pages.profile.password.forgot';

			return $this->generateView();
		}
	}

	/**
	 * function to get form of reset password
	 *
	 * @param reset link
	 */
	public function reset($link = null)
	{
		/* set api token use token public */
		Session::set('API_token', Session::get('API_token_public'));

		$API_me 										= new APIUser;
		$result 										= $API_me->getReset([
																'link'	=> $link,
															]);
		if ($result['status'] != 'success')
		{
			return Redirect::route('balin.home.index')->withErrors($result['message'])->with('msg-type', 'danger');
		}
		else
		{
			Session::put('reset_password_mail', $result['data']['email']);

			$this->page_attributes->data 				= 	[
																'me'	=> $result['data'],
															];

			$this->page_attributes->subtitle 			= 'Lupa Password';
			$this->page_attributes->breadcrumb			= [];
			$this->page_attributes->source 				= 'web_v2.pages.profile.password.reset';

			return $this->generateView();
		}
	}

	/**
	 * function to post reseted password
	 *
	 * @param new password
	 */
	public function change()
	{
		$breadcrumb									= 	[
															'Reset Password' => ''
														];
		if(Input::has('password'))
		{
			$rules 									= ['password' => 'min:8|confirmed'];

			$validator 								= Validator::make(Input::only('password', 'password_confirmation'), $rules);

			if(!$validator->passes())
			{
				return Redirect::route('balin.home.index')->withErrors($validator->errors())->with('msg-type', 'danger');
			}

			$password 								= Input::get('password');
		}
		else
		{
			\App::abort(404);
		}

		/* set api token use token public */
		Session::set('API_token', Session::get('API_token_public'));

		$email 										= Session::get('reset_password_mail');

		$API_me 									= new APIUser;
		$result 									= $API_me->postChangePassword([
																'email'	=> $email,
																'password' => $password,
															]);

		if ($result['status'] != 'success')
		{
			return Redirect::route('balin.home.index')->withErrors($result['message'])->with('msg-type', 'danger');
		}
		else
		{
			$this->page_attributes->data 				= 	[
																'me'	=> $result['data'],
															];

			$this->page_attributes->subtitle 			= 'Reset Password';
			$this->page_attributes->breadcrumb			= array_merge($breadcrumb);
			$this->page_attributes->source 				= 'web_v2.pages.profile.password.changed';

			return $this->generateView();
		}
	}
}