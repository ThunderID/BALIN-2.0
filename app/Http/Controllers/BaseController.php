<?php namespace App\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\MessageBag;

use App\API\API;
use App\API\Connectors\APIProduct;
use App\API\Connectors\APIUser;
use App\API\Connectors\APIConfig;
use Route, Session, Cache, Input, Redirect;

abstract class BaseController extends Controller
{
	protected $page_attributes;
	protected $errors;
	protected $take 				= 10;
	protected $token_public;
	protected $token_private;
	protected $template_layout;

	function __construct() 
	{
		$this->errors 				= new MessageBag();
		$this->page_attributes 		= new \Stdclass;

		$api_url 					= '/oauth/client/access_token';
		$api_data 					= 	[
											'grant_type'	=> 'client_credentials',
											'client_id'		=> 'f3d259ddd3ed8ff3843839b',
											'client_secret'	=> '4c7f6f8fa93d59c45502c0ae8c4a95b',
										];
		$api 						= new API;
		$result 					= json_decode($api->post($api_url, $api_data),true);

		// Get success API token
		if ($result['status'] == "success")
		{
			// $this->token_public = $result['data']['token']['access_token'];
			Session::set('API_token_public', $result['data']['token']['access_token']);
			Session::set('API_token', $result['data']['token']['access_token']);
		}
		else
		{
			dd('gagal login API');
		}

		//nanti kalu butuh template lebih dari satu, switch case aja disini.
		$this->layout 				= view('web_v2.page_templates.layout');
	}

	public function generateView()
  	{
  		//require
  		if (!isset($this->page_attributes->breadcrumb)){ $this->page_attributes->breadcrumb = []; }
  		if (!isset($this->page_attributes->title)){ $this->page_attributes->title = null; }
  		if (!isset($this->page_attributes->subtitle)){ $this->page_attributes->subtitle = null; }
  		if (!isset($this->page_attributes->data)){ $this->page_attributes->data = null; }
  		if (!isset($this->page_attributes->paginator)){$this->page_attributes->paginator = null;}
  		if (!Session::has('carts')) 
  		{
  			if (!Session::has('user_me'))
  			{
	  			$recommend 							= Cache::remember('recommended_batik', 30, function() {
	  				$API_product 					= new APIProduct;
	  				$recommend 						= $API_product->getIndex([
	  														'search' 	=> 	[
	  																			'name' 	=> Input::get('q'),
	  																		],
	  														'sort' 		=> 	[
	  																			'name'	=> 'asc',
	  																		],																		
	  														'take'		=> 2,
	  														'skip'		=> '',
	  													]);			

	  				return $recommend;
	  			});

	  			$this->recommend 					= $recommend;
  			}
  			else
  			{
  				Session::set('API_token', Session::get('API_token_private'));

  				$recommend 							= Cache::remember('recommended_batik', 30, function() {
  					$API_recommended				= new APIUser;
  					$recommend 						= $API_recommended->getMeRecommended([
  															'search'	=> [
  																				'user_id'	=> Session::get('user_me')['id']
  																			]
  														]);
  					return $recommend;
  				});

  				$this->recommend 					= $recommend;
  			}
  		}

  		//generate balin information
  		$APIConfig 									= new APIConfig;
		
		$config 									= $APIConfig->getIndex([
														'search' 	=> 	[
																			'default'	=> 'true',
																		],
														'sort' 		=> 	[
																			'name'	=> 'asc',
																		],
														]);

		$balin 										= $config['data'];

		unset($balin['info']);
		foreach ($config['data']['info'] as $key => $value) 
		{
			$balin['info'][$value['type']]			= $value;
		}

		//paginator
  		$paging				= $this->page_attributes->paginator;

		//initialize view
  		$this->layout 			= view($this->page_attributes->source, compact('paging'))
									->with('breadcrumb', $this->page_attributes->breadcrumb)
									->with('page_title', $this->page_attributes->title)
									->with('page_subtitle', $this->page_attributes->subtitle)
									->with('data', $this->page_attributes->data)
									->with('balin', $balin)
									;

  		//optional data
  		if (isset($this->page_attributes->search))
  		{
  			$this->layout 		= $this->layout->with('searchResult', $this->page_attributes->search);
  		}

  		// return view
		return $this->layout;		
	}

	public function generateRedirectRoute($to = null, $parameter = null)
	{
		if (count($this->errors) == 0)
		{
			return Redirect::route($to, $parameter)
					->with('msg',$this->page_attributes->success)
					->with('msg-type', 'success');
		}
		else
		{
			return Redirect::back()
					->withInput(Input::all())
					->withErrors($this->errors)
					->with('msg-type', 'danger');

		}
	}

	public function paginate($route = null, $count = null, $current = null)
	{
		//README
		//$route : route current page. $route = route('admin.product.index')
		//$count : number of data. $count = count($data)
		//$current : current page. $current = input::get($page)

		$this->page_attributes->paginator 			= new LengthAwarePaginator($count, $count, $this->take, $current);
	    $this->page_attributes->paginator->setPath($route);
	}
	// public function __construct() 
	// {
	// 	if (Session::has('user_me'))
	// 	{
	// 		if (!Session::has('API_token_authenticated'))
	// 		{
	// 			Redirect::route('balin.get.login');
	// 		}
	// 	}
		
	// 	$recommend 							= Cache::remember('recommended_batik', 30, function() 
	// 	{
	// 		$API_product 					= new APIProduct;

	// 		return $API_product->getIndex([]);
	// 	});

	// 	$this->recommend 					= $recommend;


	// 	if (Route::is('balin.campaign.join.get'))
	// 	{
	// 		$this->layout 				= view('web_v2.page_templates.layout_campaign');
	// 	}
	// 	else
	// 	{
	// 		$this->layout 					= view('web_v2.page_templates.layout')
	// 											->with('recommend', $this->recommend);
	// 	}
	// }
}
