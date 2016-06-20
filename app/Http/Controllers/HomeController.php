<?php namespace App\Http\Controllers;

use App\API\Connectors\APIProduct;
use Session, Config;

class HomeController extends BaseController 
{	
	protected $controller_name 						= 'home';

	function __construct()
	{
		parent::__construct();

		Session::set('API_token', Session::get('API_token_public'));

		$this->page_attributes->title 				= 'BALIN.ID';
		$this->page_attributes->source 				= 'web_v2.pages.home.';
		$this->page_attributes->breadcrumb			=	[];
		$this->take 								= 20;
	}

	/**
	 * display home
	 *
	 * @return view
	 */
	public function index()
	{
		//get data
		$APIProduct 							= new APIProduct;

		$product 								= $APIProduct->getIndex([
														'take'		=> 4,
														'skip'		=> 0,
													]);		
		
		$datas['batik_wanita']					= $product;
		$datas['batik_pria']					= $product;
		$datas['all']							= $product;


		$this->page_attributes->metas 			= 	[
														'og:type' 			=> 'website', 
														'og:title' 			=> 'BALIN.ID', 
														'og:description' 	=> 'Fashionable and Modern Batik',
														'og:url' 			=> $this->balin['info']['url']['value'],
														'og:image' 			=> $this->balin['info']['logo']['value'],
														'og:site_name' 		=> 'balin.id',
														'fb:app_id' 		=> Config::get('fb_app.id'),
													];

		$this->page_attributes->controller_name		= $this->controller_name;
		$this->page_attributes->subtitle 			= 'Fashionable and Modern Batik';
		$this->page_attributes->data				= $datas;

		$this->page_attributes->source 				=  $this->page_attributes->source . 'index';

		return $this->generateView();
	}
}