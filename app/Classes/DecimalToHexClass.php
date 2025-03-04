<?php 

namespace App\Classes;

class DecimalToHexClass {

	public function get_data($text)
	{

       $data['text'] = strtoupper(dechex($text));

       return $data;

	}
}