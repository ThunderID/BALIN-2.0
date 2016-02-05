<?php namespace App\Http\Controllers\Me;

use App\API\Connectors\APIUser;

use App\Http\Controllers\BaseController;

use Input, Response, Redirect, Session, Request, BalinMail;

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

		$this->page_attributes->title 			= 'BALIN.ID';
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

		$APIUser 								= new APIUser;
		$order 									= $APIUser->getMeOrderInCart(['user_id' 	=> Session::get('whoami')['id']]);

		if($order['status']!='success')
		{
			Session::forget('carts');

			\App::abort(404);
		}

		//1a. get my point
		$my_point 								= $APIUser->getMeDetail([
														'user_id'	=> Session::get('whoami')['id'],
													]);

		//1b. get my address
		$my_address 							= $APIUser->getMeAddress([
													'user_id' 	=> Session::get('whoami')['id'],
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

	/**
	 * function to post summary of balin checkout
	 * 
	 * 1. Get Session Cart & transaction
	 * 2. Parsing variable
	 * 3. Store checkout
	 * 4. Check result, send mail
	 * 5. Redirect url
	 * @return redirect url
	 */
	public function post($slug = null)
	{
		//1. Get Session Cart & transaction
		$APIUser 								= new APIUser;

		$me_order_in_cart 						= $APIUser->getMeOrderInCart(['user_id' 	=> Session::get('whoami')['id']]);


		//2. Parsing variable
		if($me_order_in_cart['status']!='success')
		{
			Session::forget('carts');

			\App::abort(404);
		}

		$temp_transaction 						= $me_order_in_cart['data'];

		//2a.change status
		$temp_transaction['status']				= 'wait';

		//3. Store checkout
		$result 								= $APIUser->postMeOrder($temp_transaction);

		//4. Check result, send mail
		if ($result['status'] != 'success')
		{
			$this->errors 							= $result['message'];
		}
		else
		{
			$mail 						= new BalinMail;

			$mail->invoice($result['data'], $this->balin['info']);

			Session::forget('carts');
		}

		//5. Redirect url
		$this->page_attributes->success 			= "Pesanan Anda sudah tersimpan.";

		return $this->generateRedirectRoute('my.balin.profile');
	}

	/**
	 * function to get voucher discount
	 * 
	 * 1. Get cart detail
	 * 2. Store voucher
	 * 3. Return result
	 * @return json response
	 */
	public function voucher()
	{
		//1. Get cart detail
		$APIUser 								= new APIUser;

		$me_order_in_cart 						= $APIUser->getMeOrderInCart(['user_id' 	=> Session::get('whoami')['id']]);

		if ($me_order_in_cart['status']!= 'success')
		{
			return Response::json(['type' => 'error', 'msg' => 'Tidak ada keranjang.'], 200);
		}

		//2. Store voucher
		$voucher 									= Input::get('voucher');
		$me_order_in_cart['data']['voucher_code']	= $voucher;

		$result 									= $APIUser->postMeOrder($me_order_in_cart['data']);

		//3. Return result
		if ($result['status'] != 'success')
		{
			return Response::json(['type' => 'error', 'msg' => $result['message']], 200);
		}

		if ($result['data']['voucher']['type']=='free_shipping_cost')
		{
			return Response::json(['type' => 'success', 'msg' => 'Selamat! Anda mendapat potongan : gratis biaya pengiriman.', 'discount' => $result['data']['voucher_discount'], 'action' => route('my.balin.checkout.get.order', $result['data']['id']) ], 200);
		}
		else
		{
			return Response::json(['type' => 'success', 'msg' => 'Selamat! Anda mendapat bonus balin point sebesar '.$result['data']['voucher']['value'].' (Balin Point akan ditambahkan jika pesanan sudah dibayar)', 'discount' => false, 'action' => route('my.balin.checkout.get.order', $result['data']['id'])], 200);
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
		$APIUser 								= new APIUser;

		$me_order_in_cart 						= $APIUser->getMeOrderInCart(['user_id' 	=> Session::get('whoami')['id']]);

		if($me_order_in_cart['status']!= 'success')
		{
			return Response::json(['type' => 'error', 'msg' => 'Tidak ada keranjang.'], 200);
		}

		//2. Store shipment
		if(!isset($me_order_in_cart['data']['shipment']))
		{
			$me_order_in_cart['data']['shipment']['id']							= '';
			$me_order_in_cart['data']['shipment']['courier_id']					= 1;
		}

		if(Input::has('address_id'))
		{
			$me_order_in_cart['data']['shipment']['address_id']					= Input::get('address_id');
			if (Input::has('flagcheck'))
			{
				$me_order_in_cart['data']['shipment']['address']['id']			= "";
				$me_order_in_cart['data']['shipment']['receiver_name']			= Input::get('name');
				$me_order_in_cart['data']['shipment']['address']['address']		= Input::get('address');
				$me_order_in_cart['data']['shipment']['address']['zipcode']		= Input::get('zipcode');
				$me_order_in_cart['data']['shipment']['address']['phone']		= Input::get('phone');
			}
			else 
			{
				$me_order_in_cart['data']['shipment']['receiver_name']			= Session::get('whoami')['name'];
				unset($me_order_in_cart['data']['shipment']['address']);
			}
		}
		else
		{
			$me_order_in_cart['data']['shipment']['address']['id']				= "";
			$me_order_in_cart['data']['shipment']['receiver_name']				= Input::get('name');
			$me_order_in_cart['data']['shipment']['address']['address']			= Input::get('address');
			$me_order_in_cart['data']['shipment']['address']['zipcode']			= Input::get('zipcode');
			$me_order_in_cart['data']['shipment']['address']['phone']			= Input::get('phone');
		}

		$result 																= $APIUser->postMeOrder($me_order_in_cart['data']);

		//3. Return result
		if ($result['status'] != 'success')
		{
			unset($me_order_in_cart['data']['shipment']['address']);
			$me_order_in_cart['data']['shipment']['address_id']					= "";

			$result2															= $APIUser->postMeOrder($me_order_in_cart['data']);

			return Response::json(['type' => 'error', 'msg' => $result['message']], 200);
		}

		// parsing array to json to parsing in form address
		$address = [	'address'			=> $result['data']['shipment']['address']['address'],
						'receiver_name'		=> $result['data']['shipment']['receiver_name'],
						'phone'				=> $result['data']['shipment']['address']['phone'],
						'zipcode'			=> $result['data']['shipment']['address']['zipcode'],
					];
					
		return Response::json(['action' => route('my.balin.checkout.get.order', $result['data']['id']), 'address' => $address], 200);
	}

	/**
	 * function to get view desktop for order detail in checkout
	 * 1. Get cart detail
	 * 2. return to view
	 */
	public function get_view($id = null)
	{
		// 1. Get detail Order
		$APIUser								= new APIUser;
		$result 								= $APIUser->getMeOrderInCart(['user_id' 	=> Session::get('whoami')['id']]);

		// 2. generate from ajax to view for order detail same for index
		// 2.a. session carts
		$carts									= Session::get('carts');

		// 2.b. get order from API setelah shipping cost
		$order 									= $result['data'];

		$data 			= 	[
								'carts'			=> Session::get('carts'),
								'order' 		=> $result['data'],
							];
		// 2.c. get model view to return
		$model 			= (Input::get('model') != 'mobile') ? 'desktop' : 'mobile';

		return View('web_v2.components.checkout.part_total_order_'. $model)->with('data', $data);
	}
}