<?php namespace App\Http\Controllers\Me;

use App\Http\Controllers\BaseController;
use App\API\Connectors\APIUser;

use Input, Redirect, Auth, Carbon, Validator, DB, App, Session;
use Illuminate\Support\MessageBag;

class OrderController extends BaseController 
{
	protected $controller_name 				= 'order';

	function __construct()
	{
		parent::__construct();
	}

	public function show($id = null)
	{		
		/* Set api token to api token private */
		Session::set('API_token', Session::get('API_token_private'));

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
}