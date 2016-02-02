<?php namespace App\Http\Controllers\Me;

use App\Http\Controllers\BaseController;
use App\API\Connectors\APIUser;

use Input, Redirect, Auth, Carbon, Validator, DB, App, Session, BalinMail;
use Illuminate\Support\MessageBag;

class OrderController extends BaseController 
{
	protected $controller_name 				= 'order';

	function __construct()
	{
		parent::__construct();

		Session::set('API_token', Session::get('API_token_private'));
	}

	public function show($id = null)
	{		
		/* Set api token to api token private */
		$API_me 							= new APIUser;

		/* ambil data order detail dari API */
		$me_order_detail					= $API_me->getMeOrderDetail([
													'user_id' 	=> Session::get('user_me')['id'],
													'order_id'	=> $id
												]);
		/* parsing data dari API */
		$data 								= 	[
													'order' 	=> $me_order_detail['data'],
												];

  		$balin 								= $this->balin;

		$page 								= view('web_v2.pages.profile.order.show', compact('balin'))
												->with('data', $data);
		return $page;
	}

	public function destroy($id = null)
	{		
		/* Set api token to api token private */
		$API_me 							= new APIUser;

		/* ambil data order detail dari API */
		$me_order_detail					= $API_me->getMeOrderDetail([
													'user_id' 	=> Session::get('user_me')['id'],
													'order_id'	=> $id
												]);
		$me_order_detail['data']['status']	= 'canceled';

		$result 								= $API_me->postMeOrder($me_order_detail['data']);

		// result
		if ($result['status'] != 'success')
		{
			$this->errors 							= $result['message'];
		}
		else
		{
			$mail 						= new BalinMail;

			$mail->canceled($result['data'], $this->balin['info']);
		}

		//return view
		$this->page_attributes->success 			= "Pesanan Anda sudah dibatalkan.";

		return $this->generateRedirectRoute('balin.profile.user.index');
	}
}