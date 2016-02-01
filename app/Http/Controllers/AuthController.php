<?php namespace App\Http\Controllers;

use App\API\API;
use App\API\Connectors\APIUser;
use App\API\Connectors\APIProduct;

use App\Http\Controllers\Controller;
use Input, Session, DB, Redirect, Response, Auth, Socialite, App, Validator, Carbon, Cookie;

class AuthController extends BaseController 
{
	protected $controller_name 				= 'Login';

	public function __construct()
	{
		parent::__construct();
		Session::set('API_token', Session::get('API_token_private'));
		$this->page_attributes->title 		= 'Balin.id';
	}

	public function doLogin()
	{ 
		$api_url 							= '/oauth/access_token';
		$api_data 							= 	[
													'email' 		=> Input::get('email'),
													'password' 		=> Input::get('password'),
													'grant_type'	=> 'password',
													'client_id'		=> 'f3d259ddd3ed8ff3843839b',
													'client_secret'	=> '4c7f6f8fa93d59c45502c0ae8c4a95b',
												];

		$api 								= new API;
		$result 							= json_decode($api->post($api_url, $api_data), true);

		if ($result['status'] == "success")
		{
		
			Session::set('API_token_private', $result['data']['token']['access_token']);
			Session::set('user_me', $result['data']['me']);

			if (!Session::has('carts'))
			{
				Session::set('API_token', Session::get('API_token_private'));	
				$API_me 								= new APIUser;
				$me_order_in_cart 						= $API_me->getMeOrderInCart([
																'user_id' 	=> Session::get('user_me')['id'],
															]);
				if ($me_order_in_cart['status'] == 'success')
				{
					$carts 									= $me_order_in_cart;
					$temp_carts 							= [];

					foreach ($carts['data']['transactiondetails'] as $k => $v)
					{
						$temp_carts[$v['varian']['product_id']]		= 	[
								'product_id'		=> $v['varian']['product_id'],
								'slug'				=> $v['varian']['product']['slug'],
								'name'				=> $v['varian']['product']['name'],
								'discount'			=> $v['discount'],
								'current_stock'		=> $v['varian']['current_stock'],
								'thumbnail'			=> $v['varian']['product']['thumbnail'],
								'price'				=> $v['price'],
						];

						$temp_varian[$v['varian']['id']] 	=	[
								'varian_id'			=> $v['varian_id'],
								'sku'				=> $v['varian']['sku'],
								'quantity'			=> $v['quantity'],
								'size'				=> $v['varian']['size'],
								'current_stock'		=> $v['varian']['current_stock'],
								'message'			=> null,
						];

						$temp_carts[$v['varian']['product_id']]['varians']	= $temp_varian;
					}
					
					Session::set('carts', $temp_carts);
				}
			}
			else
			{
				/* SET API TOKEN USE TOKEN PRIVATE */
				$temp_carts 			= 	[
											'id'					=> '',
											'user_id'				=> Session::get('user_me')['id'],
											'transact_at'			=> date('Y-m-d H:i:s'),
											'transactiondetails'	=> [],
											'transactionlogs'		=> 	[
																			'id'		=> '',
																			'status'	=> 'cart',
																			'change_at'	=> '',
																			'notes'		=> ''
																		],
											'payment'				=> [],
											'shipment'				=> []
										];

				$session_cart 			= Session::get('carts');

				foreach($session_cart as $k => $v)
				{
					foreach($v['varians'] as $k2 => $v2)
					{
						$temp_varian[] 		= 	[
													'id' 				=> '',
													'transaction_id'	=> '',
													'quantity' 			=> $v2['quantity'],
													'price'				=> $v['price'],
													'discount'			=> $v['discount'],
													'varian_id'			=> $v2['varian_id'],
													'varians'			=> [
														'id'				=> $v2['varian_id'],
														'product_id'		=> $k,
														'sku'				=> $v2['sku'],
														'size'				=> $v2['size'],
														// 'current_stock'		=> $product['data']['data'][0]['current_stock'],
														// 'on_hold_stock'		=> $product['data']['data'][0]['on_hold_stock'],
														// 'inventory_stock'	=> $product['data']['data'][0]['inventory_stock'],
														// 'reserved_stock'	=> $product['data']['data'][0]['reserved_stock'],
														// 'packed_stock'		=> $product['data']['data'][0]['packed_stock'],
													]
												];
						
					}
				}
				$temp_carts['transactiondetails']	= $temp_varian;

				Session::set('API_token', Session::get('API_token_private'));

				$API_order 							= new APIUser;
				$result 							= $API_order->postMeOrder($temp_carts);

				// result
				if ($result['status'] != 'success')
				{
					$error 				= $result['message'];
				}
			}

			return Redirect::route('balin.redeem.index');
		}
		else
		{
			return Redirect::route('balin.login.index')
							->withErrors(['Username dan password yang anda masukkan tidak cocok dengan data kami.'])
							->with('msg-type', 'danger')
							->with('msg-from', 'login');
		}
	}

	public function doLogout()
	{
		Auth::logout();
		Session::flush();

		return Redirect::route('balin.home.index');
	}

	public function activation($activation_link = null)
	{
		$breadcrumb										= 	[
																'Activation Link' => ''
															];
		/* set api token use token public */
		Session::set('API_token', Session::get('API_token_public'));

		$API_me 										= new APIUser;
		$result 										= $API_me->postActivationLink([
																'link'	=> $activation_link,
															]);

		if ($result['status'] != 'success')
		{
			return Redirect::route('balin.home.index');
		}
		else
		{
			$this->page_attributes->data 				= 	[
																'me'	=> $result['data'],
															];

			$this->page_attributes->subtitle 			= 'Activation Link';
			$this->page_attributes->breadcrumb			= array_merge($breadcrumb);
			$this->page_attributes->source 				= 'web_v2.pages.profile.activation.index';

			return $this->generateView();
		}
	}

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


	public function doSso()
	{ 
		return Socialite::driver('facebook')->redirect();
	}

	public function getSso()
	{ 
		$sso 								= (array)Socialite::driver('facebook')->user();

		$api_url 							= '/oauth/access_token';
		$api_data 							= 	[
													'email' 		=> $sso['email'],
													'password' 		=> 'facebook',
													'sso' 			=> $sso,
													'grant_type'	=> 'password',
													'client_id'		=> 'f3d259ddd3ed8ff3843839b',
													'client_secret'	=> '4c7f6f8fa93d59c45502c0ae8c4a95b',
												];

		$api 								= new API;
		$result 							= json_decode($api->post($api_url, $api_data), true);

		if ($result['status'] == "success")
		{
		
			Session::set('API_token_private', $result['data']['token']['access_token']);
			Session::set('user_me', $result['data']['me']);

			if (!Session::has('carts'))
			{
				Session::set('API_token', Session::get('API_token_private'));	
				$API_me 								= new APIUser;
				$me_order_in_cart 						= $API_me->getMeOrderInCart([
																'user_id' 	=> Session::get('user_me')['id'],
															]);
				if ($me_order_in_cart['status'] == 'success')
				{
					$carts 									= $me_order_in_cart;
					$temp_carts 							= [];

					foreach ($carts['data']['transactiondetails'] as $k => $v)
					{
						$temp_carts[$v['varian']['product_id']]		= 	[
								'product_id'		=> $v['varian']['product_id'],
								'slug'				=> $v['varian']['product']['slug'],
								'name'				=> $v['varian']['product']['name'],
								'discount'			=> $v['discount'],
								'current_stock'		=> $v['varian']['current_stock'],
								'thumbnail'			=> $v['varian']['product']['thumbnail'],
								'price'				=> $v['price'],
						];

						$temp_varian[$v['varian']['id']] 	=	[
								'varian_id'			=> $v['varian_id'],
								'sku'				=> $v['varian']['sku'],
								'quantity'			=> $v['quantity'],
								'size'				=> $v['varian']['size'],
								'current_stock'		=> $v['varian']['current_stock'],
								'message'			=> null,
						];

						$temp_carts[$v['varian']['product_id']]['varians']	= $temp_varian;
					}
					
					Session::set('carts', $temp_carts);
				}
			}
			else
			{
				/* SET API TOKEN USE TOKEN PRIVATE */
				$temp_carts 			= 	[
											'id'					=> '',
											'user_id'				=> Session::get('user_me')['id'],
											'transact_at'			=> date('Y-m-d H:i:s'),
											'transactiondetails'	=> [],
											'transactionlogs'		=> 	[
																			'id'		=> '',
																			'status'	=> 'cart',
																			'change_at'	=> '',
																			'notes'		=> ''
																		],
											'payment'				=> [],
											'shipment'				=> []
										];

				$session_cart 			= Session::get('carts');

				foreach($session_cart as $k => $v)
				{
					foreach($v['varians'] as $k2 => $v2)
					{
						$temp_varian[] 		= 	[
													'id' 				=> '',
													'transaction_id'	=> '',
													'quantity' 			=> $v2['quantity'],
													'price'				=> $v['price'],
													'discount'			=> $v['discount'],
													'varian_id'			=> $v2['varian_id'],
													'varians'			=> [
														'id'				=> $v2['varian_id'],
														'product_id'		=> $k,
														'sku'				=> $v2['sku'],
														'size'				=> $v2['size'],
														// 'current_stock'		=> $product['data']['data'][0]['current_stock'],
														// 'on_hold_stock'		=> $product['data']['data'][0]['on_hold_stock'],
														// 'inventory_stock'	=> $product['data']['data'][0]['inventory_stock'],
														// 'reserved_stock'	=> $product['data']['data'][0]['reserved_stock'],
														// 'packed_stock'		=> $product['data']['data'][0]['packed_stock'],
													]
												];
						
					}
				}
				$temp_carts['transactiondetails']	= $temp_varian;

				Session::set('API_token', Session::get('API_token_private'));

				$API_order 							= new APIUser;
				$result 							= $API_order->postMeOrder($temp_carts);

				// result
				if ($result['status'] != 'success')
				{
					$error 				= $result['message'];
				}
			}

			return Redirect::route('balin.redeem.index');
		}
		else
		{
			return Redirect::route('balin.login.index')
							->withErrors(['Username dan password yang anda masukkan tidak cocok dengan data kami.'])
							->with('msg-type', 'danger')
							->with('msg-from', 'login');
		}
	}
}