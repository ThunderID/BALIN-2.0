<?php namespace App\Http\Controllers;

use App\API\connectors\APIProduct;
use App\API\connectors\APITag;
use App\API\connectors\APIUser;
use App\API\connectors\APICategory;
use Cookie, Response, Input, Auth, App, Config, Collection, Session;

class ProductController extends BaseController 
{	
	protected $controller_name 						= 'product';

	function __construct()
	{
		parent::__construct();
		Session::set('API_token', Session::get('API_token_public'));

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

		if (Input::has('q'))
		{
			$filters 								= ['name' => Input::get('q')];
			$this->page_attributes->search 			= Input::get('q');
		}
		else
		{
			$searchResult							= null;
		}

		if (Input::has('category'))
		{
			$categories 						= ['categories' => Input::get('category')];
		}
		else
		{
			$categories							= [];
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
															'search' 	=> 	[
																				'name' 	=> Input::get('q'),
																			],
															'sort' 		=> 	[
																				'name'	=> 'asc',
																			],																		
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