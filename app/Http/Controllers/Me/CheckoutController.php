<?php namespace App\Http\Controllers\Me;

use App\API\Connectors\APIUser;

use App\Http\Controllers\BaseController;

use Input, Response, Redirect, Session, Request;

/**
 * Used for Checkout Controller
 * 
 * @author cmooy
 */
class CheckoutController extends BaseController 
{
	protected $controller_name 					= 'checkout';

	public function __construct()
	{
		parent::__construct();

		Session::put('API_token', Session::get('API_token_private'));

		$this->page_attributes->title 			= 'Checkout';
		$this->page_attributes->source 			= 'web_v2.pages.checkout.';
		$this->page_attributes->breadcrumb		=	[
														'Checkout' 	=> route('my.balin.checkout.get'),
													];
	}

	/**
	 * function to get summary of balin checkout
	 * 
	 * 1. Get Session Cart & transaction
	 * 2. Generate breadcrumb
	 * 3. Generate view
	 * @return view
	 */
	public function get()
	{	
		//1.Get Session Cart & transaction
		$carts 									= Session::get('carts');

		$API_me 								= new APIUser;
		$order 									= $API_me->getMeOrderInCart([
														'user_id' 	=> Session::get('user_me')['id'],
													]);

		if($order['status']!='success')
		{
			\App::abort(404);
		}

		//1a. get my point
		$my_point 								= $API_me->getMeDetail([
														'user_id'	=> Session::get('user_me')['id'],
													]);

		//1b. get my address
		$my_address 							= $API_me->getMeAddress([
													'user_id' 	=> Session::get('user_me')['id'],
												]);

		//2. Generate breadcrumb
		$breadcrumb								= 	[
														'Checkout' => route('my.balin.checkout.get')
													];

		$this->page_attributes->breadcrumb		= array_merge($this->page_attributes->breadcrumb, $breadcrumb);
		
		//3. Generate view
		$this->page_attributes->data			= 	[
														'carts'			=> $carts,
														'order'			=> $order,
														'my_point'		=> $my_point['data']['total_point'],
														'my_address'	=> $my_address['data']['data'],
													];


		$this->page_attributes->subtitle 		= 'Checkout';
		$this->page_attributes->source 			=  $this->page_attributes->source . 'index';

		return $this->generateView();
	}

	/* FUNCTION ADD TO CART SESSION */
	public function post($slug = null)
	{
		$API_me 								= new APIUser;

		/* Ambil Data transaction */
		$me_order_in_cart 						= $API_me->getMeOrderInCart([
														'user_id' 	=> Session::get('user_me')['id']
													]);
		/* Set temporary transaction */
		$temp_transaction 						= 	[
														'id'					=> $me_order_in_cart['data']['id'],
														'user_id'				=> Session::get('user_me')['id'],
														'transact_at'			=> $me_order_in_cart['data']['transact_at'],
														'transactiondetails'	=> [],
														'transactionlogs'		=> [],
														'payment'				=> [],
														'shipment'				=> 	[
																						'id'				=> '',
																						'receiver_name'		=> Input::get('receiver_name'),
																					],
														'status'				=> 'wait',
														'courier'				=> [],
													];

		/* get session carts */
		$session_cart 			= Session::get('carts');

		/* create array for transaction details */
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
																		'id'			=> $v2['varian_id'],
																		'product_id'	=> $k,
																		'sku'			=> $v2['sku'],
																		'size'			=> $v2['size'],
																	]
										];
				
			}
		}

		$temp_transaction['transactiondetails']		= $temp_varian;

		/* create for transaction logs */
		$temp_transaction['transactionlogs'][]		= 	[
															'id'			=> '',
															'status'		=> 'wait',
															'change_at'		=> date('Y-m-d H:i:s'),
														];

		/* create for shipment addres */
		$temp_transaction['shipment']['address'] 	= 	[
															'id' 			=> Input::get('address_id'),
															'phone'			=> Input::get('phone'),
															'address'		=> Input::get('address'),
															'zipcode'		=> Input::get('zipcode'),
														];
		$temp_transaction['shipment']['courier_id']	= 	2;

		Session::set('API_token', Session::get('API_token_private'));

		$API_order 									= new APIUser;
		$result 									= $API_order->postMeOrder($temp_transaction);

		// result
		if ($result['status'] != 'success')
		{
			$this->errors 							= $result['message'];
		}
		else
		{
			Session::forget('carts');
		}

		//return view
		$this->page_attributes->success 			= "Pesanan Anda sudah tersimpan.";

		return $this->generateRedirectRoute('balin.profile.user.index');
	}

	/**
	 * function to get voucher discount
	 * 
	 * 1. Get transaction
	 * 2. Store voucher
	 * 3. Return result
	 * @return json response
	 */
	public function voucher()
	{
		$API_me 								= new APIUser;

		$me_order_in_cart 						= $API_me->getMeOrderInCart([
														'user_id' 	=> Session::get('user_me')['id'],
													]);

		if($me_order_in_cart['status']!= 'success')
		{
			return Response::json(['type' => 'error', 'msg' => 'Tidak ada keranjang.'], 200);
		}

		$voucher 									= Input::get('voucher');
		$me_order_in_cart['data']['voucher_code']	= $voucher;

		$result 									= $API_me->postMeOrder($me_order_in_cart['data']);

		// result
		if ($result['status'] != 'success')
		{
			return Response::json(['type' => 'error', 'msg' => $result['messag']], 200);
		}

		if ($result['data']['voucher']['type']=='free_shipping_cost')
		{
			return Response::json(['type' => 'success', 'msg' => 'Selamat! Anda mendapat potongan : gratis biaya pengiriman.', 'discount' => $result['data']['voucher_discount']], 200);
		}
		else
		{
			return Response::json(['type' => 'success', 'msg' => 'Selamat! Anda mendapat bonus balin point sebesar '.$result['data']['voucher']['value'].' (Balin Point akan ditambahkan jika pesanan sudah dibayar)', 'discount' => false], 200);
		}
	}

	/**
	 * function to get shipping cost
	 * 
	 * 1. Get cart detail
	 * 2. Store shipment
	 * 3. Return result
	 * @return json response
	 */
	public function shipping()
	{
		//1. Get cart detail
		$API_me 								= new APIUser;

		$me_order_in_cart 						= $API_me->getMeOrderInCart([
														'user_id' 	=> Session::get('user_me')['id'],
													]);

		if($me_order_in_cart['status']!= 'success')
		{
			return Response::json(['type' => 'error', 'msg' => 'Tidak ada keranjang.'], 200);
		}

		//2. Store shipment
		if(!isset($me_order_in_cart['shipment']))
		{
			$me_order_in_cart['data']['shipment']['id']				= "";
			$me_order_in_cart['data']['shipment']['courier_id']		= 1;
		}

		$me_order_in_cart['data']['shipment']['address']['id']		= "";
		$me_order_in_cart['data']['shipment']['address']['address']	= Input::get('address');
		$me_order_in_cart['data']['shipment']['address']['zipcode']	= Input::get('zipcode');
		$me_order_in_cart['data']['shipment']['address']['phone']	= Input::get('phone');

		$result 								= $API_me->postMeOrder($me_order_in_cart['data']);

		//3. Return result
		if ($result['status'] != 'success')
		{
			return Response::json(['type' => 'error', 'msg' => $result['message']], 200);
		}

		
		return Response::json(['transaction' => $result], 200);
	}
}