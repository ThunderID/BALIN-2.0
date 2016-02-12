<?php 
namespace App\API\Connectors;

class APISendMail extends APIData 
{
	function __construct() 
	{
		parent::__construct();

		$this->api->timeout 				= 10;
		$this->api->basic_url				= 'localhost:9000';
	}

	public function welcomemail($user, $store)
	{
		$this->api_url 						= '/shop/welcome';

		$this->api_data 					= array_merge($this->api_data, ["user" => $user, "store" => $store]);

		return $this->post();
	}	

	public function resetpassword($user, $store)
	{
		$this->api_url 						= '/shop/password/reset';

		$this->api_data 					= array_merge($this->api_data, ["user" => $user, "store" => $store]);

		return $this->post();
	}	

	public function invoice($invoice, $store)
	{
		$this->api_url 						= '/shop/invoice';

		$this->api_data 					= array_merge($this->api_data, ["invoice" => $invoice, "store" => $store]);

		return $this->post();
	}	

	public function cancelorder($order, $store)
	{
		$this->api_url 						= '/shop/canceled';

		$this->api_data 					= array_merge($this->api_data, ["order" => $order, "store" => $store]);

		return $this->post();
	}	
}