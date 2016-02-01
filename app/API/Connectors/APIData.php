<?php 
namespace App\API\Connectors;

use App\API\API;
use Exception, Session, Redirect;

abstract class APIData
{
	protected $api_url;
	protected $api_data;

	function __construct() 
	{
		$this->api_data 				= ['access_token' => Session::get('API_token')];
		
		if (is_null(Session::get('API_token')))
		{
			// dd('kosong');
			Redirect::route('balin.home.index')->send();
		}
	}

	protected function get()
	{
		$api 						= new API;
		$queryString 				= Null;

		foreach ($this->api_data as $title => $data) {
			if(is_array($data))
			{
				foreach ($data as $subTitle => $subData) {
					if(!is_null($subData) || !empty($subData))
					{
						$queryString = $queryString . $title . "[" .  $subTitle . "]=" . $subData . "&";				
					}
				}
			}
			else
			{
				$queryString 		= $queryString . $title . "=" . $data . "&";
			}		
		}

		$queryString 				= str_replace(' ', '%20', $queryString);


		$this->api_url				= $this->api_url . '?' . $queryString;

		$result 					= json_decode($api->get($this->api_url), true);

		return $this->validateResponse($result);
	}

	protected function post()
	{
		$api 						= new API;

		$result 					= json_decode($api->post($this->api_url, $this->api_data),true);

		return $this->validateResponse($result);
	}

	protected function delete()
	{
		$api 						= new API;
		
		$queryString 				= null;

		foreach ($this->api_data as $key => $data) 
		{
			$queryString 			= $queryString . $key . '=' . $data . '?' ;
		}

		$this->api_url				= $this->api_url . '?' . $queryString;

		$result 					= json_decode($api->delete($this->api_url), true);		

		return $this->validateResponse($result);
	}	

	private function validateResponse($result)
	{
		// validate response
		try 
		{
		    if(empty($result['status']))
		    {
				print_r("RESPONSE ERROR : NO STATUS FROM SERVER!");
				dd($result);
		    }

		    if(empty($result['data']))
		    {
				print_r("RESPONSE ERROR : NO DATA FROM SERVER!");
				dd($result);
		    }
		} 
		catch (Exception $e) 
		{
			print_r("ERROR : UNKNOWN RESPONSE FROM SERVER!");
			dd($result);
		}

		// data
		if(is_null($result['data']))
		{
			$result['data'] 		= [];
		}

		return $result;
	}
}