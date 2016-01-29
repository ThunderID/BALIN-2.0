<?php namespace App\Http\Controllers;

use App\API\connectors\APIUser;
use Input, Response, Redirect, Session, Auth, Request;

class CheckoutController extends BaseController 
{
	protected $controller_name 					= 'checkout';

	public function __construct()
	{
		parent::__construct();
		Session::set('API_token', Session::get('API_token_private'));

		$this->page_attributes->title 			= 'Checkout';
		$this->page_attributes->source 			= 'web_v2.pages.checkout.';
		$this->page_attributes->breadcrumb		=	[
														'Checkout' 	=> route('balin.checkout.index'),
													];
	}

	public function index()
	{	
		$breadcrumb								= 	[
														'Checkout' => route('balin.checkout.index')
													];

		Session::set('API_token', Session::get('API_token_private'));	
		$carts 									= Session::get('carts');

		$API_me 								= new APIUser;
		/* Ambil Data transaction */
		$me_order_in_cart 						= $API_me->getMeOrderInCart([
														'user_id' 	=> Session::get('user_me')['id'],
													]);
		/* Ambil data point user */
		$my_point 								= $API_me->getMyPoint([
														'user_id'	=> Session::get('user_me')['id'],
													]);

		if($me_order_in_cart['status']!='success')
		{
			$order 								= null;
		}
		else
		{
			$order 								= $me_order_in_cart;
		}

		$this->page_attributes->data			= 	[
														'carts'			=> $carts,
														'order' 		=> $order,
														'my_point'		=> $my_point,
													];

		$this->page_attributes->subtitle 		= 'Checkout';
		$this->page_attributes->breadcrumb		= array_merge($this->page_attributes->breadcrumb, $breadcrumb);
		$this->page_attributes->source 			=  $this->page_attributes->source . 'index';

		return $this->generateView();
	}

	/* FUNCTION ADD TO CART SESSION */
	public function store ($slug = null)
	{
		Session::set('API_token', Session::get('API_token_private'));	

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


	// FUNCTION CHECK VOUCHER
	public function getCheckVoucher ()
	{
		// $voucher 				= Input::get('voucher');
		$voucher['type']			= 'free_shipping_cost';
		$voucher['value']			= 0;
		$voucher['quota']			= 12;
		// $voucher 				= Voucher::code($code)->type(['free_shipping_cost', 'debit_point'])->ondate('now')->first();

		if (!$voucher)
		{
			return Response::json(['type' => 'error', 'msg' => 'Voucher Tidak valid!'], 200);
		}
		elseif ($voucher['quota'] - 1 < 0)
		{
			return Response::json(['type' => 'error', 'msg' => 'Voucher Tidak dapat dipakai.'], 200);
		}
		else
		{
			if ($voucher['type']=='free_shipping_cost')
			{
				return Response::json(['type' => 'success', 'msg' => 'Selamat! Anda mendapat potongan : gratis biaya pengiriman.', 'discount' => true], 200);
			}
			else
			{
				return Response::json(['type' => 'success', 'msg' => 'Selamat! Anda mendapat bonus balin point sebesar '.$voucher['value'].' (Balin Point akan ditambahkan jika pesanan sudah dibayar)', 'discount' => false], 200);
			}
		}
	}

	public function getShippingCost ()
	{
		//get shipping cost
		if (Input::has('zipcode'))
		{
			$zipcode 			= Input::get('zipcode');
			$data['cost'] 			= 'IDR '.number_format(40000, 0, ',', '.');
		}
		elseif (Input::has('address'))
		{
			if (Input::get('address') == 0)
			{
				$data['cost'] 			= 'IDR '.number_format(20000, 0, ',', '.');
			}

			// $address 			= Address::id(Input::get('address'))->first();
			$data['cost'] 			= 'IDR '.number_format(30000, 0, ',', '.');
		}
		else
		{
			\App::abort(404);
		}
		
		return Response::json(['address' => $data], 200);
	}

	public function getAddress ($id)
	{
		// $addresses 				= Address::oldershipmentbycustomer(Auth::user()->id)
		// 							->where('addresses.id', $id)
		// 							->get();

		$data['receiver_name']	= 'Adam Suthim';
		$data['address']		= 'Puri Cempaka Putih 2 AS 86';
		$data['zipcode']		= '65111';
		$data['phone']			= '089654562911';
		$data['cost']			= 'IDR 30.000';

		return Response::json(['address' => $data], 200);
	}
}