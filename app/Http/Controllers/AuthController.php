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

	public function doSso()
	{ 
		return Socialite::driver('facebook')->redirect();
	}

	public function getSso()
	{ 
		if (Session::has('is_campaign'))
		{
			$is_active 					= true;
		}
		else
		{
			$is_active 					= false;
		}

		$user 							= Socialite::driver('facebook')->user();
		$registered 					= User::email($user->email)->first();

		if ($registered)
		{
			return Redirect::back()->withErrors($registered->getError())
								->with('msg', 'Email sudah terdaftar')
								->with('msg-type', 'danger');
		}
		else
		{
			$registered 				= new User;
			$registered->fill([
				'name'					=> $user->name,
				'email'					=> $user->email,
				'gender'				=> $user->user['gender'],
				'sso_id' 				=> $user->id,
				'sso_media' 			=> 'facebook',
				'sso_data' 				=> json_encode($user->user),
				'role' 					=> 'customer',
				'is_active'				=> $is_active,
			]);

			if (!$registered->save())
			{
				return Redirect::back()->withErrors($registered->getError())->with('msg-type', 'danger');
			}

			if ($is_active)
			{
				$result                 = $this->dispatch(new SaveCampaign($registered, 'promo_referral'));
				if ($result->getStatus()!='success')
				{
					return Redirect::back()->withErrors($result->getErrorMessage())->with('msg-type', 'danger');
				}
			}
		}

		Auth::loginUsingId($registered->id);

		$redirect 					= Session::get('login_redirect');

		Session::forget('login_redirect');
		
		$transaction           	 	= Transaction::userid(Auth::user()->id)->status('cart')->wherehas('transactiondetails', function($q){$q;})->with(['transactiondetails', 'transactiondetails.varian', 'transactiondetails.varian.product'])->first();

		if ($transaction)
		{
			$result             	= $this->dispatch(new SaveToCookie($transaction));

			if ($result->getStatus()=='success' && !is_null($result->getData()))
			{
				$baskets 			= $result->getData();
				Session::put('baskets', $baskets);

				return Redirect::intended($redirect);
			}
			else
			{
				return Redirect::back()->withErrors(['Tidak bisa login.'])->with('msg-type', 'danger');
			}
		}

		return Redirect::intended($redirect)
							->with('msg', 'Terima kasih sudah mendaftar diwebsite kami.')
							->with('msg-type', 'success');
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

	public function doForgot()
	{
		$email 							= Input::Get('email');
		$user 							= User::email($email)->first();

		if (!$user)
		{
			return Redirect::back()->withErrors('Email tidak terdaftar')->with('msg-type', 'danger');
		}
		
		$result							= $this->dispatch(new SendResetPasswordEmail($user));

		if ($result->getStatus()=='success')
		{
			return Redirect::route('balin.home.index')
				->with('msg','Permintaan reset password sudah dikirim')
				->with('msg-type', 'success');
		}

		return Redirect::route('balin.home.index')->withErrors($result->getErrorMessage())->with('msg-type', 'danger');
	}

	public function getForgot($link = null)
	{
		$user 								= User::resetpasswordlink($link)->first();

		if (!$user)
		{
			App::abort(404);
		}

		$dateexpired						= Carbon::now();

		if ($user->expired_at->lt($dateexpired))
		{
			return Redirect::route('balin.home.index')->withErrors('Link Expired')->with('msg-type', 'danger');
		}

		$this->layout->page					= view('web_v2.page.login.index')
												->with('controller_name', $this->controller_name)
												->with('email', $user->email);

		$this->layout->controller_name		= $this->controller_name;

		return $this->layout;
	}

	public function postForgot()
	{
		$email 								= Input::get('email');

		$user 								= User::email($email)->first();

		if (!$user)
		{
			App::abort(404);
		}

		if (Input::has('password'))
		{
			$validator 						= Validator::make(Input::only('password', 'password_confirmation'), ['password' => 'required|min:8|confirmed']);

			if (!$validator->passes())
			{
				return Redirect::back()
					->withInput()
					->withErrors($validator->errors())
					->with('msg-type', 'danger');
			}

		}

		DB::beginTransaction();

		$user->fill([
				'password'					=> Input::get('password'),
				'reset_password_link'		=> '',
				'expired_at' 				=> NULL,
		]);


		if (!$user->save())
		{
			DB::rollback();

			return Redirect::back()
					->withInput()
					->withErrors($user->getError())
					->with('msg-type', 'danger');
		}
		else
		{
			DB::commit();

			return Redirect::route('frontend.home.index')
				->with('msg','Password sudah berhasil diubah silahkan login dengan menggunakan password yang baru.')
				->with('msg-type', 'success');
		}
	}
}