<?php namespace App\Http\Controllers;

use Input, Config, Session;

/**
 * Used for page info of balin
 * 
 * @author cmooy
 */
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

	/**
	 * display about us
	 *
	 * @return view
	 */
	public function aboutus()
	{
		//1. generate breadcrumb
		$breadcrumb									= 	[
															'About Us' 	=> route('balin.about.us'),
														];

		$this->page_attributes->breadcrumb			= array_merge($this->page_attributes->breadcrumb, $breadcrumb);

		//2. generate view
		$this->page_attributes->subtitle 			= 'Fashionable and Modern Batik';
		$this->page_attributes->data				= 	[];
		$this->page_attributes->metas 				= 	[
															'og:type' 			=> 'website', 
															'og:title' 			=> 'BALIN.ID', 
															'og:description' 	=> 'Fashionable and Modern Batik',
															'og:url' 			=> $this->balin['info']['url']['value'],
															'og:image' 			=> $this->balin['info']['logo']['value'],
															'og:site_name' 		=> 'balin.id',
															'fb:app_id' 		=> Config::get('fb_app.id'),
														];
		$this->page_attributes->source 				=  $this->page_attributes->source . 'about_us';

		return $this->generateView();
	}

	/**
	 * display contact us
	 *
	 * @return view
	 */
	public function contactus()
	{
		//1. generate breadcrumb
		$breadcrumb									= 	[
															'Contact Us' 	=> route('balin.contact.us'),
														];

		$this->page_attributes->breadcrumb			= array_merge($this->page_attributes->breadcrumb, $breadcrumb);

		//2. generate view
		$this->page_attributes->subtitle 			= 'Fashionable and Modern Batik';
		$this->page_attributes->data				= 	[];
		$this->page_attributes->metas 			= 	[
														'og:type' 			=> 'website', 
														'og:title' 			=> 'BALIN.ID', 
														'og:description' 	=> 'Fashionable and Modern Batik',
														'og:url' 			=> $this->balin['info']['url']['value'],
														'og:image' 			=> $this->balin['info']['logo']['value'],
														'og:site_name' 		=> 'balin.id',
														'fb:app_id' 		=> Config::get('fb_app.id'),
													];
		$this->page_attributes->source 				=  $this->page_attributes->source . 'contact_us';

		return $this->generateView();
	}
}