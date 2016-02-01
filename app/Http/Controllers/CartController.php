<?php namespace App\Http\Controllers;

use App\API\API;
use App\API\connectors\APIProduct;
use App\API\connectors\APIUser;

use Input, Response, Redirect, Session, Auth, Request, Collection, Carbon;

class CartController extends BaseController 
{
	protected $controller_name 					= 'cart';

	public function __construct()
	{
		parent::__construct();
		Session::set('API_token', Session::get('API_token_public'));

		$this->page_attributes->title 				= 'Cart';
		$this->page_attributes->source 				= 'web_v2.pages.cart.';
		$this->page_attributes->breadcrumb			=	[
															'Cart' 	=> route('balin.cart.index'),
														];
	}

	public function index()
	{	
		$breadcrumb									= 	[
															'Cart' => route('balin.cart.index')
														];

		$carts 										= Session::get('carts');

		if (Session::has('user_me'))
		{
			Session::set('API_token', Session::get('API_token_private'));	

			$API_me 								= new APIUser;
			$me_order_in_cart 						= $API_me->getMeOrderInCart([
															'user_id' 	=> Session::get('user_me')['id'],
														]);
			$temp_carts 							= [];
			$temp_varians 							= [];

			foreach ($me_order_in_cart['data']['transactiondetails'] as $k => $v)
			{
				$temp_carts['slug']					= $v['varian']['product']['slug'];
				$temp_carts['name']					= $v['varian']['product']['name'];
				$temp_carts['discount']				= $v['discount'];
				$temp_carts['current_stock']		= $v['varian']['current_stock'];
				$temp_carts['thumbnail']			= $v['varian']['product']['thumbnail'];
				$temp_carts['price']				= $v['price'];
					
				$varian_temp[$v['varian']['id']]	= 	[
															'varian_id'			=> $v['varian']['id'],
															'quantity'			=> $v['quantity'],
															'size'				=> $v['varian']['size'],
															'current_stock'		=> $v['varian']['current_stock'],
															'message'			=> null,
														];
				$temp_carts['varians']				= $varian_temp;
				$carts[$v['varian']['product_id']]	= $temp_carts;
			}
		}

		$this->page_attributes->data				= 	[
															'carts' 	=> $carts,
														];

		$this->page_attributes->subtitle 			= 'Carts';
		$this->page_attributes->breadcrumb			= array_merge($this->page_attributes->breadcrumb, $breadcrumb);
		$this->page_attributes->source 				=  $this->page_attributes->source . 'index';

		return $this->generateView();
	}

	/* FUNCTION ADD TO CART SESSION */
	public function store($slug = null)
	{
		// call API product
		$API_product 						= new APIProduct;
		$product 							= $API_product->getIndex([
													'search' 	=> 	[
																		'slug' 	=> $slug,
																	],
												]);

		$carts 								= Session::get('carts');
		$qty 								= Input::get('qty');
		$varianids 							= Input::get('varianids');

		$varians 							= [];
		$qtys 								= [];

		// make Array varian per product
		foreach ($varianids as $key => $value) 
		{
			$varians[$value] 				= $value;
			$qtys[$value]					= $qty[$key];
		}

		$cart								= $this->addToCart($carts, $product['data']['data'][0], $qtys, $varians);
		$carts 								= Session::put('carts', $cart);

		return Response::json(['carts' => $cart], 200);
	}

	public function edit ()
	{
	
	}

	public function update($slug = null, $varian_id = null)
	{
		// call API product
		$API_product 						= new APIProduct;
		$product 							= $API_product->getIndex([
													'search' 	=> 	[
																		'slug' 	=> $slug,
																	],
												]);

		$carts 								= Session::get('carts');
		$product_id							= $product['data']['data'][0]['id'];

		$carts[$product_id]['varians'][$varian_id]['quantity']	= Input::get('qty');

		$varianids 							= [];
		$qtys 								= [];

		// make Array varian per product
		foreach ($carts[$product_id]['varians'] as $key => $value) 
		{
			$varianids[$key] 				= $value['varian_id'];
			$qtys[$key]						= $value['quantity'];
		}

		$cart								= $this->addToCart($carts, $product['data']['data'][0], $qtys, $varianids);
		$carts 								= Session::put('carts', $cart);
	}

	// FUNCTION REMOVE CART
	public function destroy ()
	{
		
	}

	// FUNCTION EMPTY CART
	public function clean()
	{
			
	}

	/* FUNCTION AJAX GET LIST IN CART DROPDOWN REFERSH ITEM */
	public function getListBasket() 
	{
		return View('web_v2.components.cart.list_ajax_cart_dropdown');
	}

	// FUNCTION ADD TO CART INTO TO ARRAY
	function addToCart($temp_carts, $product, $qtys, $varianids) 
	{
		$cart['product_id']					= $product['id'];
		$cart['slug']						= $product['slug'];
		$cart['name']						= $product['name'];
		$cart['discount']					= isset($product['discount']) ? $product['discount'] : 0;
		$cart['current_stock']				= (int) $product['current_stock'];
		$cart['thumbnail']					= $product['thumbnail'];
		$cart['price']						= isset($product['price']) ? $product['price'] : 0;

		if (Session::has('user_me'))
		{
			/* SET API TOKEN USE TOKEN PRIVATE */
			Session::put('API_token', Session::get('API_token_private'));

			/* GET ORDER STATUS IN CART FROM USER LOGGED */
			$API_in_cart 			= new APIUser;
			$order_in_cart 			= $API_in_cart->getMeOrderInCart([
											'user_id' => Session::get('user_me')['id']
										]);

			$temp_order 			= $order_in_cart['data'];
			$post_order 			= 	[
											'id'					=> isset($order_in_cart['data']['id']) ? $order_in_cart['data']['id'] : '',
											'user_id'				=> Session::get('user_me')['id'],
											'transact_at'			=> (isset($order_in_cart['data']['transact_at'])&&(empty($order_in_cart['data']['transact_at']))) ? date('Y-m-d H:i:s', strtotime($order_in_cart['data']['transact_at'])) : '',
											'transactiondetails'	=> isset($order_in_cart['data']['transactiondetails']) ? $order_in_cart['data']['transactiondetails'] : [],
											'transactionlogs'		=> 	[
																			'id'		=> '',
																			'status'	=> 'cart',
																			'change_at'	=> '',
																			'notes'		=> ''
																		],
											'payment'				=> [],
											'shipment'				=> []
										];
			if (Input::has('voucher_id'))
			{
				$post_order['voucher_id']	= Input::get('voucher_id');
			}
		}

		$msg 								= null;
		$varian 							= [];
		$tmp_order 							= [];
		$tmp 								= [];


		/* CHECK VARIAN YANG BERISI JUMLAH KUANTITASNYA */
		foreach ($varianids as $key => $value) 
		{
			if (isset($qtys[$value]) && $qtys[$value]!=0 && isset($temp_carts[$product['id']]['varians'][$value]))
			{
				$validqty 					= $qtys[$value];
			}
			elseif(isset($temp_carts[$product['id']]['varians'][$value]))
			{
				$validqty 					= $temp_carts[$product['id']]['varians'][$value]['quantity']; 
			}
			else
			{
				$validqty 					= $qtys[$value];
			}

			/* GET COLLECTION PRODUCT VARIAN */
			$collection_varians				= collect($product['varians']);

			/* SEARCH VARIAN ID YANG DIDALAM COLLECTION */
			$varianp 						= $collection_varians->where('id', $value)->all();
			$varian_temp					= [];

			/* REMOVE INDEX 0 */
			foreach ($varianp as $k => $v) 
			{
				foreach($v as $k2 => $v2) 
				{
					$varian_temp[$k2] 		= $v2;
				}
			}

			/* CHECK CURRENT STOCK != 0 */
			if (isset($varian_temp))
			{
				if ($varian_temp['current_stock'] < $validqty && ($varian_temp['current_stock'] != 0))
				{
					$msg 			= 'Maaf stock tidak mencukupi';
					$validqty 		= $qtys[$value];
				}
				else
				{
					$msg 			= null;
				}
			}

			/* IF QUANTITY NOT 0 */
			if ($validqty > 0)
			{
				/* CART IN SESSESION NOT AUTHENTICATED */
				$varian[$varian_temp['id']]	= 	[	
													'varian_id' 		=> $varian_temp['id'], 
													'sku'				=> $varian_temp['sku'],
													'quantity' 			=> $validqty, 
													'size' 				=> $varian_temp['size'], 
													'current_stock' 	=> $varian_temp['current_stock'],
													'message'  			=> $msg
												];

				/* SAVE ORDER TO USER LOGGED */
				if (Session::has('user_me'))
				{
					if (isset($order_in_cart['data']['id']))
					{
						$flag 				= 0;

						/* CHECK TRANSACTION DETAIL IN SAME VARIAN */
						foreach ($order_in_cart['data']['transactiondetails'] as $k => $v)
						{
							if ($v['varian_id'] == $varian_temp['id'])
							{
								$flag 					= 1;
								$trs_index 				= $k;
								break;
							}
						}

						/* IN SAME TRANSACTION DETAIL REMOVE TO ARRAY AND INSERT NEW ROW */
						if ($flag == 1)
						{
							array_except($post_order, ['transactiondetails.'. $trs_index]);
							$post_order['transactiondetails'][$trs_index]['quantity'] 	= $validqty;
							$tmp  														= $post_order['transactiondetails'];
						}

						/* IF NOT SAME CREATE TRANSACTION DETAIL ADD NEW ROW ARRAY */
						else if (($flag == 0) && ($validqty != 0))
						{
							$tmp[]	 = 	[
											'id' 				=> '',
											'transaction_id'	=> $order_in_cart['data']['id'],
											'quantity' 			=> $validqty,
											'price'				=> $product['price'],
											'discount'			=> $order_in_cart['data']['transactiondetails'][0]['discount'],
											'varian_id'			=> $varian_temp['id'],
											'varian'			=> 	[
																	'id'				=> $varian_temp['id'],
																	'product_id'		=> $product['id'],
																	'sku'				=> $varian_temp['sku'],
																	'size'				=> $varian_temp['size'],
																	'current_stock'		=> $varian_temp['current_stock'],
																	'on_hold_stock'		=> $varian_temp['on_hold_stock'],
																	'inventory_stock'	=> $varian_temp['inventory_stock'],
																	'reserved_stock'	=> $varian_temp['reserved_stock'],
																	'packed_stock'		=> $varian_temp['packed_stock']
																]
										];
							array_push($post_order['transactiondetails'], $tmp);
						}
					}
					else
					{
						$tmp[]	= 	[
										'id' 			=> '',
										'quantity' 		=> $validqty,
										'price'			=> $cart['price'],
										'discount'		=> $cart['discount'],
										'varian_id'		=> $varian_temp['id'],
										'varian'		=> 	[
																'id'				=> $varian_temp['id'],
																'product_id'		=> $product['id'],
																'sku'				=> $varian_temp['sku'],
																'size'				=> $varian_temp['size'],
																'current_stock'		=> $varian_temp['current_stock'],
																'on_hold_stock'		=> $varian_temp['on_hold_stock'],
																'inventory_stock'	=> $varian_temp['inventory_stock'],
																'reserved_stock'	=> $varian_temp['reserved_stock'],
																'packed_stock'		=> $varian_temp['packed_stock']
															]
									];
					}

				}
				
				if ($validqty == 0)
				{
					unset($varian[$varian_temp['id']]);
				}
			}

		}
		
		if (Session::has('user_me'))
		{
			$post_order['transactiondetails']	= $tmp;

			$API_order 							= new APIUser;
			$result 							= $API_order->postMeOrder($post_order);

			// result
			if ($result['status'] != 'success')
			{
				$error 				= $result['message'];
			}
		}

		$cart['varians']					= $varian;
		$temp_carts[$product['id']]			= $cart;

		if (count($temp_carts[$product['id']]['varians'])==0)
		{
			unset($temp_carts[$product['id']]);
		}

		return $temp_carts;
	}

	function proses_carts($varianids, $qtys, $product, $temp_cart, $index_cart, $index_iteration, $temp_cart_now)
	{
		$a = [];
		$collection_varians		= collect($product['varians']);

		foreach($varianids as $key => $value)
		{
			$varianp 			= $collection_varians->where('id', (int) $value)->all();
			$varian_temp		= [];

			if ((isset($qtys[$value]) && $qtys[$value] != 0) && (isset($temp_cart_now['varian']['id'])) && ($temp_cart_now['varian']['id'] == $value) )
			{
				$validqty 					= (int) $qtys[$value] + $temp_cart_now['quantity'];
			}
			else 
			{
				$validqty 					= (int) $qtys[$value];
			}

			foreach ($varianp as $k => $v) 
			{
				foreach($v as $k2 => $v2) 
				{
					$varian_temp[$k2] 	= $v2;
				}
			}

			if ($varian_temp['current_stock'] < $validqty && ($varian_temp['current_stock']!=0))
			{
				$msg 			= 'Maaf stock tidak mencukupi';
				$validqty 		= $qtys[$value];
			}
			else
			{
				$msg 			= null;
			}

			$x = $index_iteration;

			if (is_null($temp_cart_now))
			{
				if ($temp_cart_now['id'] == $product['id'])
				{
					if (isset($temp_cart_now['varian']['id']))
					{
						$x = $index_cart;
					}
				}
			}
			$a[$index_iteration] = $index_cart; 

			if ($validqty > 0)
			{
				$trs_detail[$x]	= [	'id'			=> $product['id'],
									'quantity'	=> $validqty,
									'price'		=> isset($product['price']) ? $product['price'] : 0,
									'discount'	=> isset($product['discount']) ? $product['discount'] : 0,
									'varian'		=> [ 'id'				=> $varian_temp['id'],
													'product_id'		=> $product['id'],
													'sku'			=> $varian_temp['sku'],
													'size'			=> $varian_temp['size'],
													'current_stock'	=> $varian_temp['current_stock'],
													'on_hold_stock'	=> $varian_temp['on_hold_stock'],
													'inventory_stock'	=> $varian_temp['inventory_stock'],
													'reserved_stock'	=> $varian_temp['reserved_stock'],
													'packed_stock'		=> $varian_temp['packed_stock'],
													'product'			=> [	'id'				=> $product['id'],
																		'name'			=> $product['name'],
																		'upc'			=> isset($product['upc']) ? $product['upc'] : '' ,
																		'slug'			=> isset($product['slug']) ? $product['slug'] : '',
																		'description'		=> isset($product['description']) ? $product['description'] : '',
																		'current_stock'	=> isset($product['current_stock']) ? $product['current_stock'] : 0,
																		'on_hold_stock'	=> isset($product['on_hold_stock']) ? $product['on_hold_stock'] : 0,
																		'inventory_stock'	=> isset($product['inventory_stock']) ? $product['inventory_stock'] : 0,
																		'reserved_stock'	=> isset($product['reserved_stock']) ? $product['reserved_stock'] : 0 ,
																		'packed_stock'		=> isset($product['packed_stock']) ? $product['packed_stock'] : 0,
																		'cart_item'		=> '',
																		'sold_item'		=> '',
																		'price'			=> isset($product['price']) ? $product['price'] : 0,
																		'promo_price'		=> isset($product['promo_price']) ? $product['promo_price'] : 0,
																		'thumbnail'		=> isset($product['thumbnail']) ? $product['thumbnail'] : '',
																		'image_xs'		=> isset($product['image_xs']) ? $product['image_xs'] : '',
																		'image_sm'		=> isset($product['image_sm']) ? $product['image_sm'] : '',
																		'image_md'		=> isset($product['image_md']) ? $product['image_md'] : '',
																		'image_lg'		=> isset($product['image_lg']) ? $product['image_lg'] : ''
																		]
													]
									];

				if ($validqty==0)
				{
					unset($trs_detail[$x]);
				}

				$index_iteration++;
			}
		}
		return $trs_detail;
	}
}