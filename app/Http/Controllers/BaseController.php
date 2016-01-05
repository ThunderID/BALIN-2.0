<?php namespace App\Http\Controllers;

use App\API\API;
use Route, Session;

abstract class BaseController extends Controller
{
	protected $layout;
	protected $stores;

	public function __construct() 
	{
		$apiUrl 							= '/oauth/access_token';
		$apiData 							= 	[
													'email' 		=> 'cs@balin.id',
													'password' 		=> 'admin',
													'grant_type'	=> 'password',
													'client_id'		=> 'f3d259ddd3ed8ff3843839b',
													'client_secret'	=> '4c7f6f8fa93d59c45502c0ae8c4a95b',
												];

		$api 								= new API;
		$result 							= json_decode($api->post($apiUrl, $apiData),true);

		// Get success API token
		if ($result['status'] == "success")
		{
			Session::set('APIToken', $result['data']['token']['access_token']);
		}
		else
		{
			dd('gagal login');
		}

		if (Route::is('balin.campaign.join.get'))
		{
			$this->layout = view('web_v2.page_templates.layout_campaign');
		}
		else
		{
			$this->layout = view('web_v2.page_templates.layout');
		}
	}

}
