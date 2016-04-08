<?php namespace EpnBzLib;
 
class Client
{
	protected $ch;

	public function __construct()
	{
		$this->ch = curl_init();
		curl_setopt($this->ch , CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($this->ch , CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($this->ch , CURLOPT_COOKIEJAR, __DIR__.'cookie.txt');
		curl_setopt($this->ch , CURLOPT_COOKIEFILE, __DIR__.'cookie.txt');
	}

	public function request($url, $ajax)
	{
		if ($ajax) {
			curl_setopt($this->ch , CURLOPT_HTTPHEADER, array('X-Requested-With:XMLHttpRequest'));
		} else {
			curl_setopt($this->ch , CURLOPT_HTTPHEADER, array('X-Requested-With:none'));
		}
		curl_setopt($this->ch , CURLOPT_URL, $url);
		$result = curl_exec($this->ch);
		return $result;
	}

	public function get($url, $ajax = false)
	{
		curl_setopt($this->ch , CURLOPT_POST, 0);
		return $this->request($url, $ajax);
	}

	public function post($url, $data, $ajax = false)
	{
		curl_setopt($this->ch , CURLOPT_POST, 1);
		curl_setopt($this->ch , CURLOPT_POSTFIELDS, $data);
		return $this->request($url, $ajax);
	}

	public function getInfo()
	{
		return curl_getinfo($this->ch);
	}

	public function getUrl()
	{
		return $this->getInfo()['url'];
	}
}