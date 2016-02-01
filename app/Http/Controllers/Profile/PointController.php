<?php namespace App\Http\Controllers\Profile;

use App\API\Connectors\APIUser;
use App\Http\Controllers\BaseController;

use Input, Redirect, Auth, Carbon, Validator, DB, App, Session;
use Illuminate\Support\MessageBag;

class PointController extends BaseController 
{
	protected $controller_name 					= 'point';

	public function index($id = null)
	{		
		Session::set('API_token', Session::get('API_token_private'));

		$API_me 							= new APIUser;
		$me_point 							= $API_me->getMePoint([
													'user_id' 	=> $id,
												]);
		$me_detail 							= $API_me->getMeDetail([
													'user_id'	=> $id,
												]);

		$data 								= 	[
													'point'	=> $me_point['data'],
													'me'	=> $me_detail['data'],
												];
												
		$page 								= view('web_v2.pages.profile.point.index')
												->with('data', $data);
		return $page;
	}
}