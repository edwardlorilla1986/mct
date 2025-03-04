<?php 

namespace App\Classes;

class HtmlDecodeClass {

	public function get_data($code)
	{
		$data['code'] = html_entity_decode($code);

        return $data;
	}
}