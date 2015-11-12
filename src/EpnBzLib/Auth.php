<?php namespace EpnBzLib;

class Auth
{
	protected $auth_url = "https://epn.bz/ru/auth/login";

	public function __construct($client)
	{
		$this->client = $client;
	}

	public function login($username, $password)
	{
		$data = array(
			"username" => $username,
			"password" => $password);
		$this->client->post($this->auth_url, $data);
		return true;
	}
}