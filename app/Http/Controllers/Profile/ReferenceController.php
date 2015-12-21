<?php namespace App\Http\Controllers\Web\Profile;

use App\Http\Controllers\Web\Controller;

use Input, Redirect, Auth, Carbon, Validator, DB, App;
use Illuminate\Support\MessageBag;

class ReferenceController extends Controller 
{
	protected $controller_name 					= 'reference';

	public function create()
	{		
		$breadcrumb								= ['Balin Point' => route('balin.profile.reference.create')];

		$this->layout->page 					= view('web.page.profile.reference.create');
		$this->layout->breadcrumb				= $breadcrumb;
		$this->layout->controller_name			= $this->controller_name;
		$this->layout->page_title 				= 'BALIN.ID';
		$this->layout->page_subtitle 			= 'Tambah Pemberi Referral';

		return $this->layout->page;
	}
	
	public function store()
	{
		dd(Input::all());
	}
}