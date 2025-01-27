<?php 

namespace App\Classes;

class BinaryToHexClass {

	public function get_data($binary)
	{

       $data['text'] = strtoupper(dechex(bindec($binary)));

       return $data;

	}
}