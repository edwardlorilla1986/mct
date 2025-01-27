<?php 

namespace App\Classes;

class HtmlEncodeClass {

	public function get_data($code)
	{
		$data['code'] = htmlentities($code);

        return $data;
	}
}