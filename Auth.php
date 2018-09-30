<?php

class Fortnite_Auth
{
	public $auth;
	
	public function __construct($client)
	{
		$this->Client = $client;
	}

	public function setKey($key = '')
	{
		if(!empty($key))
		{
			$this->auth = $key;

			return '';
		}

		FortniteClient::Exception('Invalid API key.');
	}
}

?>