<?php namespace App\Http\Controllers;

use App\API\Connectors\APIProduct;
use App\API\Connectors\APITag;
use App\API\Connectors\APIUser;
use App\API\Connectors\APICategory;
use Cookie, Response, Input, Auth, App, Config, Collection, Session, BalinMail;

class ProductController extends BaseController 
{	
	protected $controller_name 						= 'product';

	function __construct()
	{
		parent::__construct();

		if(Session::has('user_me'))
		{
			Session::put('API_token', Session::get('API_token_private'));
		}
		else
		{
			Session::put('API_token', Session::get('API_token_public'));
		}

		$this->page_attributes->title 				= 'BALIN.ID';
		$this->page_attributes->source 				= 'web_v2.pages.product.';
		$this->page_attributes->breadcrumb			=	[
															'Produk' 	=> route('balin.product.index'),
														];
		$this->take 								= 20;
	}

	public function index()
	{
		//initialize 
		$filters 									= null;
		$search 									= [];

		if(Input::has('q'))
		{
			$search 								= ['name' 			=> Input::get('q')];
			$filters 								= 	[
															'name' 	=> 	Input::get('q')
														];
		}
		
		if(Input::has('category'))
		{
			$search['categories']					= Input::get('category');
		}

		if(Input::has('tag'))
		{
			$search['tags']							= Input::get('tag');
		}

		if(Input::has('label'))
		{
			$search['labelname']					= Input::get('label');
		}

		if (Input::has('sort'))
		{
			$sort_item 							= explode('-', Input::get('sort'));
			$sort 								= [$sort_item[0] => $sort_item[1]];
		}
		else
		{
			$sort								= ['name' => 'asc'];
		}

		//get filter removal
		$searchresult 							= [];
		foreach (Input::all() as $key => $value) 
		{
			if(in_array($key, ['tag', 'label', 'category']))
			{
				$query_string 					= Input::all();
				unset($query_string['page']);
				unset($query_string[$key]);
				$searchresult[$value]			= route('balin.product.index', $query_string);
			}
		}

		//get curent page
		if (is_null(Input::get('page')))
		{
			$page 									= 1;
		}
		else
		{
			$page 									= Input::get('page');
		}

		// data here
		$APIProduct 								= new APIProduct;

		$product 									= $APIProduct->getIndex([
															'search' 	=> 	$search,
															'sort' 		=> 	$sort,
															'take'		=> $this->take,
															'skip'		=> ($page - 1) * $this->take,
														]);

		$API_category 								= new APICategory;
		$get_api_category							= $API_category->getIndex([
															'search' 	=> 	[
																				'name' 	=> Input::get('q'),
																			],
															'sort' 		=> 	[
																				'name'	=> 'asc',
																			],
														]);
		$API_tag 									= new APITag;
		$get_api_tag								= $API_tag->getIndex([
															'search' 	=> 	[
																				'name' 	=> Input::get('q'),
																			],
															'sort' 		=> 	[
																				'name'	=> 'asc',
																			],
														]);

		$collection_category						= new Collection;
		$collection_category->add($get_api_category['data']['data']);

		$collection_tag 							= new Collection;
		$collection_tag->add($get_api_tag['data']['data']);

		$category 									= $collection_category->sortBy('name')->all();
		$tag 										= $collection_tag->sortBy('name')->all();

		//paginate
		$this->paginate(route('balin.product.index'), $product['data']['count'], $page);

		//breadcrumb
		$breadcrumb									= 	[
															'Produk' => route('balin.product.index')
														];

		//generate View
		$this->page_attributes->search 				= $searchresult;
		$this->page_attributes->subtitle 			= 'Produk Batik Modern';
		$this->page_attributes->data				= 	[
															'product' 	=> $product,
															'tag'		=> $tag,
															'category'	=> $category
														];

		$this->page_attributes->breadcrumb			= array_merge($this->page_attributes->breadcrumb, $breadcrumb);
		$this->page_attributes->source 				=  $this->page_attributes->source . 'index';

		return $this->generateView();
	}

	public function show($slug = null)
	{
		// PRODUCT DETAIL
		$API_product 							= new APIProduct;
		$product 								= $API_product->getIndex([
														'search' 	=> 	[
																			'slug' 	=> $slug,
																		],
													]);
		// //PRODUCT RELATED
		$related 								= $API_product->getIndex([
														'search' 	=> 	[
																			'name' 	=> Input::get('q'),
																		],
														'sort' 		=> 	[
																			'name'	=> 'asc',
																		],																		
														'take'		=> 2,
													]);	

		//breadcrumb
		$breadcrumb								= 	[	
														'Produk' 							=> route('balin.product.index'),
														$product['data']['data'][0]['name'] => route('balin.product.show', $product['data']['data'][0]['slug'])
													];
		//generate View
		$this->page_attributes->subtitle 		= $product['data']['data'][0]['name'];
		$this->page_attributes->data			= 	[
														'product' 	=> $product,
														'related'	=> $related,
													];

		$this->page_attributes->breadcrumb		= array_merge($this->page_attributes->breadcrumb, $breadcrumb);
		$this->page_attributes->source 			=  $this->page_attributes->source . 'show';

		return $this->generateView();
	}
}