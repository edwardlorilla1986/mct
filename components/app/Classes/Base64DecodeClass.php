<?php 

namespace App\Classes;

class Base64DecodeClass {

	public function get_data($text)
	{

	    $decoded = base64_decode($text, true);
	    if($text === base64_encode($decoded)) {
	        $data['code'] =  $decoded;
	    }
	    else $data['code'] = $text;    

	    return $data;

	}
}