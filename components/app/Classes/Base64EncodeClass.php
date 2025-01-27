<?php 

namespace App\Classes;

class Base64EncodeClass {

	public function get_data($text)
	{

        $data['code'] = base64_encode($text);

        return $data;

	}
}