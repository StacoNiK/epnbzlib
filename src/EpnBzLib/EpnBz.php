<?php namespace EpnBzLib;

class EpnBz
{

	public function __construct($epn_login, $epn_password)
	{
		$this->client = new Client();
		$auth = new Auth($this->client);
		if (!$auth->login($epn_login, $epn_password)) {
			throw new BadAuthException('error');
			return false;
		} else {
			$this->auth = true;
		}
	}

	public function getUrl($url, $name = false)
	{
		if (!$name) {
			$name = rand(1, 4512312).rand(5342, 1231313);
		}
		$this->client->get($url);
		$ali_url = $this->client->getUrl(); 

		$temp = json_encode(array("format" => "1","isAllow" => 0,"link" => $ali_url,"desc" => $name,"image" => "","rejectChange" => false,"expiration_time" => "","no_affiliate_direct" => true,"lang" => null,"selected_banners"=> array(),"size" => "300x250"));
		$create_url = 'https://epn.bz/ru/creative/create';
		$res = $this->client->post($create_url, $temp, true);

		$list_url = 'https://epn.bz/ru/creative/list';
		$list_temp = '{"page":1,"pagebase":"#/creative/tab/list","description":""}';
		$result = json_decode($this->client->post($list_url, $list_temp), true);
		foreach ($result as $creatives) {
			foreach ($creatives as $creative) {
				if ($creative['description'] == $name) {
					return $creative['code'];
				}
			}
		}
		return false;
	}

	public function short($url)
	{
		$short_url = 'https://epn.bz/ru/creative/url-to-short';
		$data = json_encode(array('url' => $url));
		$return = trim($this->client->post($short_url, $data, true));
		if (strpos($return, 'ali.pub') === false) {
			return false;
		}
		return $return;
	}
}