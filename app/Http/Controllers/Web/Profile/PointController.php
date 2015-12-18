<?php namespace App\Http\Controllers\Web\Profile;

use App\Http\Controllers\Web\Controller;

use Input, Redirect, Auth, Carbon, Validator, DB, App;
use Illuminate\Support\MessageBag;

class PointController extends Controller 
{
	protected $controller_name 					= 'point';

	public function index()
	{		
		$breadcrumb								= ['Balin Point' => route('balin.profile.point.index')];

		$this->layout->page 					= view('web.page.profile.point.index');
		$this->layout->breadcrumb				= $breadcrumb;
		$this->layout->controller_name			= $this->controller_name;
		$this->layout->page_title 				= 'BALIN.ID';
		$this->layout->page_subtitle 			= 'History Balin Point';

		return $this->layout->page;
	}
}