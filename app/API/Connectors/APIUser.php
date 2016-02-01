<?php 
namespace App\API\Connectors;

use Exception, Session;

class APIUser extends APIData
{
	function __construct() 
	{
		parent::__construct();
	}

	/*--- use token public ----*/
	/* post user signup */
	public function postDataSignUp ($data)
	{
		$this->api_url 						= '/customer/sign/up';
		$this->api_data 					= array_merge($this->api_data, ["customer" => $data]);

		return $this->post();
	}	

	/* post user activation */
	public function postActivationLink ($data)
	{
		$this->api_url						= '/customer/activate';
		$this->api_data 					= array_merge($this->api_data, $data);

		return $this->post();
	}
	/*--- end use token public ---*/

	/* post user forgot password */
	public function postForgot($data)
	{
		$this->api_url						= '/customer/forgot/password';
		$this->api_data 					= array_merge($this->api_data, $data);

		return $this->post();
	}
	/*--- end post user forgot password ---*/

	/* get user reset password */
	public function getReset($parameter = null)
	{
		$this->api_url						= '/customer/reset/'.$parameter['link'];
		$this->api_data 					= array_merge($this->api_data, $parameter);

		return $this->get();
	}
	/*--- end get user reset password ---*/

	/* post user change password */
	public function postChangePassword($data)
	{
		$this->api_url						= '/customer/change/password';
		$this->api_data 					= array_merge($this->api_data, $data);

		return $this->post();
	}
	/*--- end post user change password ---*/

	/*---- use token private ----*/
	/* post user update profile */
	public function postDataUpdate ($data) 
	{
		$this->api_url						= '/me/'. Session::get('user_me')['id'] .'/update';
		$this->api_data 					= array_merge($this->api_data, ["customer" => $data]);

		return $this->post();
	}

	/* get data user detail */
	public function getMeDetail ($parameter = null)
	{
		if (!is_null($parameter))
		{
			$this->api_url 					= '/me/' .$parameter['user_id'];
			$this->api_data 				= array_merge($this->api_data, $parameter);
		}

		return $this->get();
	}

	/* get order transaction status type 'cart' */
	public function getMeOrderInCart ($parameter = null)
	{
		if (!is_null($parameter))
		{
			$this->api_url 					= '/me/' . $parameter['user_id'] .'/incart';
			$this->api_data 				= array_merge($this->api_data, $parameter);
		}

		return $this->get();
	}

	/* get data order user tidak termasuk order type 'cart' */
	public function getMeOrder ($parameter)
	{
		if (!is_null($parameter))
		{
			$this->api_url 					= '/me/' . $parameter['user_id'] .'/orders';
			$this->api_data 				= array_merge($this->api_data, ["orders" => $parameter]);
		}

		return $this->get();
	}

	/* post data order transaction user */
	public function postMeOrder ($data)
	{
		$this->api_url 						= '/me/'. Session::get('user_me')['id'] .'/order/store';
		$this->api_data 					= array_merge($this->api_data, ["order" => $data]);

		return $this->post();
	}

	/* get detail order user id */
	public function getMeOrderDetail ($parameter = null) 
	{
		if (!is_null($parameter))
		{
			$this->api_url 					= '/me/' . $parameter['user_id'] .'/order/' . $parameter['order_id'];
			$this->api_data 				= array_merge($this->api_data, $parameter);
		}

		return $this->get();
	}

	/* get recommended product in not cart & user login */
	public function getMeRecommended ($parameter = null)
	{
		if (!is_null($parameter))
		{
			$this->api_url 					= '/me/' . Session::get('user_me')['id'] .'/products/recommended';
			$this->api_data 				= array_merge($this->api_data, $parameter);
		}

		return $this->get();
	}

	/* get list point history user */
	public function getMyPoint ($parameter = null)
	{
		if (!is_null($parameter))
		{
			$this->api_url					= '/me/' . Session::get('user_me')['id'] . '/points';
			$this->api_data 				= array_merge($this->api_data, $parameter);
		}

		return $this->get();
	}

	/* post reference code user */
	public function postMyReferrence ($data)
	{
		$this->api_url 						= '/me/'. Session::get('user_me')['id'] .'/redeem';
		$this->api_data 					= array_merge($this->api_data, $data);

		return $this->post();
	}
	/*--- end token private ----*/
}