<?php namespace App\Http\Controllers;

use Cookie, Response, Input, Auth, App, Config, \Illuminate\Support\Collection;

class ProductController extends BaseController 
{	
	protected $controller_name 					= 'product';

	public function index($page = 1)
	{
		$breadcrumb								= ['Produk' => route('balin.product.index')];

		$this->layout->page 					= view('web_v2.pages.product.index');

		$this->layout->page->category 			= [];
		$this->layout->page->tag_types 			= [];
		$this->layout->page->data 				= [];

		$this->layout->breadcrumb				= $breadcrumb;
		$this->layout->controller_name			= $this->controller_name;
		$this->layout->page->page_title 		= 'BALIN.ID';
		$this->layout->page->page_subtitle 		= 'Produk Batik Modern - ' . $page;

		return $this->layout;
	}

	public function show($slug = null)
	{

	}
}