<?php 
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\AdminController;
use Input, Session, DB, Redirect, Response, Auth;

class DashboardController extends AdminController
{
	public function __construct()
	{
		parent::__construct();
		$this->page_attributes->title = 'Dashboard';
	}

	public function index()
	{
		$this->page_attributes->source 		= 'admin.pages.home.dashboard';
		$this->page_attributes->nav 		= 'dashboard';

		return $this->generateView();
	}
}
