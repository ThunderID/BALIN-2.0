<?php namespace App\Http\Controllers\Web;

use App\Http\Controllers\Web\Controller;
use Config;

class HomeController extends Controller 
{
	protected $controller_name 					= 'home';

	public function index()
	{
		$this->layout->page 					= view('web.page.home.index');
		$this->layout->controller_name			= $this->controller_name;
		$this->layout->page->page_title 		= 'BALIN.ID';
		$this->layout->page->page_subtitle 		= 'Fashionable and Modern Batik';

		$this->layout->page->metas 				= 	[
														'og:type' 			=> 'website', 
														'og:title' 			=> 'BALIN.ID', 
														'og:description' 	=> 'Fashionable and Modern Batik',
														// 'og:url' 			=> $this->stores['url'],
														// 'og:image' 			=> $this->stores['logo'],
														'og:site_name' 		=> 'balin.id',
														'fb:app_id' 		=> Config::get('fb_app.id'),
													];
		return $this->layout;
	}
}