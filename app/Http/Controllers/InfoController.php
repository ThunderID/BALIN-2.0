<?php namespace App\Http\Controllers;

use Cookie, Response, Input, Auth, App, Config, Collection, Session;

class InfoController extends BaseController 
{	
	protected $controller_name 						= 'info';

	function __construct()
	{
		parent::__construct();
		Session::set('API_token', Session::get('API_token_public'));

		$this->page_attributes->title 				= 'BALIN.ID';
		$this->page_attributes->source 				= 'web_v2.pages.info.';
		$this->page_attributes->breadcrumb			=	[
														];
	}

	public function aboutus()
	{
		$this->page_attributes->metas 			= 	[
														'og:type' 			=> 'website', 
														'og:title' 			=> 'BALIN.ID', 
														'og:description' 	=> 'Fashionable and Modern Batik',
														// 'og:url' 			=> $this->stores['url'],
														// 'og:image' 			=> $this->stores['logo'],
														'og:site_name' 		=> 'balin.id',
														'fb:app_id' 		=> Config::get('fb_app.id'),
													];
		//breadcrumb
		$breadcrumb									= 	[
															'About Us' 	=> route('balin.about.us'),
														];

		$this->page_attributes->breadcrumb			= array_merge($this->page_attributes->breadcrumb, $breadcrumb);

		//generate View
		$this->page_attributes->subtitle 			= 'Fashionable and Modern Batik';
		$this->page_attributes->data				= 	[];
		$this->page_attributes->source 				=  $this->page_attributes->source . 'about_us';

		return $this->generateView();
	}

	public function contactus()
	{
		$this->page_attributes->metas 			= 	[
														'og:type' 			=> 'website', 
														'og:title' 			=> 'BALIN.ID', 
														'og:description' 	=> 'Fashionable and Modern Batik',
														// 'og:url' 			=> $this->stores['url'],
														// 'og:image' 			=> $this->stores['logo'],
														'og:site_name' 		=> 'balin.id',
														'fb:app_id' 		=> Config::get('fb_app.id'),
													];
		//breadcrumb
		$breadcrumb									= 	[
															'Contact Us' 	=> route('balin.contact.us'),
														];

		$this->page_attributes->breadcrumb			= array_merge($this->page_attributes->breadcrumb, $breadcrumb);

		//generate View
		$this->page_attributes->subtitle 			= 'Fashionable and Modern Batik';
		$this->page_attributes->data				= 	[];

		$this->page_attributes->source 				=  $this->page_attributes->source . 'contact_us';

		return $this->generateView();
	}
}