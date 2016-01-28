<?php namespace App\Http\Controllers\Profile;

use App\Http\Controllers\BaseController;

use Input, Redirect, Auth, Carbon, Validator, DB, App;
use Illuminate\Support\MessageBag;

class ReferenceController extends Controller 
{
	protected $controller_name 		= 'reference';

	public function create()
	{		
		$breadcrumb					= ['Balin Point' => route('balin.profile.reference.create')];

		$page 						= view('web.page.profile.reference.create');

		return $page;
	}
	
	public function store()
	{
		dd(Input::all());
	}
}