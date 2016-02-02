<?php namespace App\Http\Controllers\Me;

use App\API\Connectors\APIUser;

use App\Http\Controllers\BaseController;

use Session, BalinMail;

class OrderController extends BaseController 
{
	protected $controller_name 						= 'order';

	function __construct()
	{
		parent::__construct();

		Session::set('API_token', Session::get('API_token_private'));

		$this->page_attributes->title 				= 'BALIN.ID';
	}

	/**
	 * function to generate view show particular order
	 *
	 * @return view
	 */
	public function show($id = null)
	{		
		//1. Ambil data order detail dari API
		$APIUser 							= new APIUser;

		$me_order_detail					= $APIUser->getMeOrderDetail([
													'user_id' 	=> Session::get('whoami')['id'],
													'order_id'	=> $id
												]);
		if($me_order_detail['status']!='success')
		{
			\App::abort(404);
		}

		//2. parsing data dari API
		$data 								= 	[
													'order' 	=> $me_order_detail['data'],
												];

  		$balin 								= $this->balin;

		//3. Generate view
		$page 								= view('web_v2.pages.profile.order.show', compact('balin'))->with('data', $data);

		return $page;
	}

	/**
	 * function to cancel order
	 *
	 * @return redirect url
	 */
	public function destroy($id = null)
	{		
		//1.  ambil data order detail dari API
		$APIUser 							= new APIUser;

		$me_order_detail					= $APIUser->getMeOrderDetail([
													'user_id' 	=> Session::get('whoami')['id'],
													'order_id'	=> $id
												]);

		if($me_order_detail['status']!='success')
		{
			\App::abort(404);
		}

		//2.  Set status cancel
		$me_order_detail['data']['status']	= 'canceled';

		//3.  Store order
		$result								= $APIUser->postMeOrder($me_order_detail['data']);

		//4. Check result
		if ($result['status'] != 'success')
		{
			$this->errors					= $result['message'];
		}
		else
		{
			$mail 						= new BalinMail;

			$mail->canceled($result['data'], $this->balin['info']);
		}

		//5. Generate view
		$this->page_attributes->success 			= "Pesanan Anda sudah dibatalkan.";

		return $this->generateRedirectRoute('my.balin.profile');
	}
}