<?php namespace App\Http\Controllers;

abstract class AdminController extends Controller 
{
	function __construct() 
	{
		//nanti kalu butuh template lebih dari satu, switch case aja disini.
		$this->layout = view('admin.page_templates.layout');
	}
}
