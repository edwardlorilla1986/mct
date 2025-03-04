<?php 

namespace App\Classes;

class UrlEncodeClass {

	public function get_data($url)
	{
		$data['url'] = urlencode($url);

        return $data;
	}
}