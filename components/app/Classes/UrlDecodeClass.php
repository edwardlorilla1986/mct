<?php 

namespace App\Classes;

class UrlDecodeClass {

	public function get_data($url)
	{
		$data['url'] = urldecode($url);

        return $data;
	}
}