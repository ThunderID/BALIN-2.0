<?php 
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\AdminController;
use Input, Session, DB, Redirect, Response, Auth;

class DashboardController extends AdminController
{
	/**
	* Instantiate a new UserController instance.
	*/
	public function __construct()
	{
		parent::__construct();
	}

	protected $view_name 		= 'Dashboard';
	
	public function index()
	{
		// switch(strtolower(Auth::user()->role))
		// {
		// 	case 'store_manager';
		// 		$view 			= 'store_manager';
		// 	break; 
		// 	case 'admin';
		// 		$view 			= 'admin';
		// 	break; 
		// 	default;
		// 		$view 			= 'staff';
		// 	break; 
		// }
		
		$breadcrumb				= [];

		$this->layout 				= view('admin.pages.home.dashboard')
									->with('WB_breadcrumbs', $breadcrumb)
									->with('WT_pagetitle', $this->view_name)
									->with('WT_pageSubTitle','')
									->with('nav_active', 'dashboard')
									->with('subnav_active', 'dashboard')
									;
		return $this->layout;
	}
}
