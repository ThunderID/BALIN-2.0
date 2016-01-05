<?php namespace App\Http\Controllers;

use App\API\connectors\APIProduct;
use Cookie, Response, Input, Auth, App, Config, \Illuminate\Support\Collection;

class ProductController extends BaseController 
{	
	protected $controller_name 					= 'product';

	function __construct()
	{
		parent::__construct();
	}

	public function index($page = 1)
	{
		$breadcrumb									= ['Produk' => route('balin.product.index')];
		$filters 									= null;

		if (Input::has('q'))
		{
			$filters 								= ['name' => Input::get('q')];
			$this->page_attributes->search 			= Input::get('q');
		}
		else
		{
			$searchResult							= null;
		}

		// data here
		$APIProduct 								= new APIProduct;
		$product 									= $APIProduct->getIndex([
															'name' 	=> Input::get('q')
														]);

		// dd($product);

		$this->layout->page 					= view('web_v2.pages.product.index');
		$this->layout->page->category 			= [];
		$this->layout->page->tag_types 			= [];
		$this->layout->page->datas 				= $product;
		$this->layout->page->page_title 		= 'BALIN.ID';
		$this->layout->page->page_subtitle 		= 'Produk Batik Modern - ' . $page;

		$this->layout->breadcrumb				= $breadcrumb;
		$this->layout->controller_name			= $this->controller_name;

		return $this->layout;
	}

	public function show($slug = null)
	{
		// $image 									= ['http://drive.thunder.id/file/public/4/1/2015/12/06/05/paniya-long-front.jpg', 'http://drive.thunder.id/file/public/4/1/2015/12/06/05/avani-short-front.jpg', 'http://drive.thunder.id/file/public/4/1/2015/12/06/04/pavana-short-front.jpg'];
		// $name 									= ['Batik Pavana Short Sleeve', 'Batik Paniya Long Sleeve', 'Batik Avani Long Sleeve'];
		// $price 									= ['350000', '300000', '390000'];
		// $data['thumbnail'] 						= $image[array_rand($image)];
		// $data['name']							= $name[array_rand($name)];
		// $data['price']							= $price[array_rand($price)];
		// $data['slug']							= str_slug($data['name'], '-');
		// $data['gallery']						= $image;
		// $data['description']					= 'Sparkle up your charm with a dress like this. Embellished Shift Dress dari ZALORA tampil chic dengan rhinestone. Sempurna untuk tampilan evening date. <br><br>- Stretchable poliester kombinasi<br>- Blush<br>- Kerah bulat<br>- Lengan pendek<br>- Resleting belakang<br>- Aksen bordir, mesh<br>- Regular fit<br>- Unlined';

		// $size_fit 								= strpos($data['name'], 'long');
		// $data['size_fit']						= ($size_fit !== false) ? 'size-long' : 'size-short'; 

		// for ($x=0; $x<4; $x++) 
		// {
		// 	$datas[$x]['thumbnail'] 			= $image[array_rand($image)];
		// 	$datas[$x]['name']					= $name[array_rand($name)];
		// 	$datas[$x]['prices']				= $price[array_rand($price)];
		// 	$datas[$x]['slug']					= str_slug($datas[$x]['name'], '-');
		// }

		// PRODUCT DETAIL
		$APIProduct 							= new APIProduct;
		$product 								= $APIProduct->getShow($slug);

		// PRODUCT RELATED
		$APIProduct 							= new APIProduct;
		$related 								= $APIProduct->getIndex([
														'name' 	=> Input::get('q')
													]);	

		$breadcrumb								= ['Produk' => route('balin.product.index'),
													$product['data']['name'] => route('balin.product.show', $product['data']['slug'])
												];

		$this->layout->page 					= view('web_v2.pages.product.show');
		$this->layout->page->data				= $product;
		$this->layout->page->related			= $related;
		$this->layout->page->page_title 		= 'BALIN.ID';
		$this->layout->page->page_subtitle 		= $product['data']['name'];

		$this->layout->breadcrumb 				= $breadcrumb;
		$this->layout->controller_name 			= $this->controller_name;

		return $this->layout;
	}
}