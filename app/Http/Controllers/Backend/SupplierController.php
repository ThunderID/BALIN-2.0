<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\AdminController;
use Input, Session, DB, Redirect;

class SupplierController extends AdminController 
{      
	public function __construct()
	{
		parent::__construct();
		$this->page_attributes->title = 'Supplier';
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
															'Data Supplier' 	=> route('admin.supplier.index'),
														];		
		$this->page_attributes->source 				= 'admin.pages.supplier.index';
		$this->page_attributes->nav 				= 'barang';
		$this->page_attributes->subnav 				= 'supplier';

		return $this->generateView();
	}

	public function show($id)
	{

	}


	public function create($id = null)
	{

	}

	public function edit($id)
	{

	}

	public function store($id = null)
	{

	}

	public function Update($id)
	{

	}

	public function destroy($id)
	{

    }
}