<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\AdminController;
use Input, Session, DB, Redirect;

class ProductController extends AdminController 
{      
	public function __construct()
	{
		parent::__construct();
		$this->page_attributes->title = 'Produk';
	}

	public function index()
	{
		//initialize 
		$filters 									= null;

		if(Input::has('q'))
		{
			$filters 								= ['name' => Input::get('q')];
			$this->page_attributes->search 			= Input::get('q');
		}
		else
		{
			$searchResult							= null;
		}


		// data here
		$this->page_attributes->data				= [];


		//generate View
		$this->page_attributes->breadcrumb			=	[	
															'Data Produk' 	=> route('admin.data.product.index'),
														];		
		$this->page_attributes->source 				= 'admin.pages.produk.index';
		$this->page_attributes->nav 				= 'barang';
		$this->page_attributes->subnav 				= 'produk';

		return $this->generateView();
	}

	public function show($id)
	{

	}


	public function create($id = null)
	{
		// initialize
		if($id) 
		{
			//get data
			$this->page_attributes->data			= [];


			$this->page_attributes->breadcrumb		= 	[	
															'Data Produk' 			=> route('admin.data.product.index'),
															'Edit '	.$product->name	=> route('admin.data.product.create', ['id' => $id] ),
														];															

			$this->page_attributes->subtitle		= 'Edit '.$product->name;
		}
		else
		{
			$this->page_attributes->breadcrumb		= 	[	
															'Data Produk' 			=> route('admin.data.product.index'),
															'Data Baru' 			=> route('admin.data.product.create'),
														];

			$this->page_attributes->subtitle 		= 'Baru';
		}

		//generate View	
		$this->page_attributes->source 				= 'admin.pages.produk.create';
		$this->page_attributes->nav 				= 'barang';
		$this->page_attributes->subnav 				= 'produk';

		return $this->generateView();
	}

	public function edit($id)
	{

	}

	public function store($id = null)
	{
		//get data
		$inputs 									= Input::all();

		//save data
		$this->errors->add('a', 'aaaa');
		//return
		$this->page_attributes->success			= 'halo';
		
		return  $this->generateRedirectRoute('admin.data.product.index');
	}

	public function Update($id)
	{

	}

	public function destroy($id)
	{

    }
}