<?php 

namespace App\Classes;

class HexToBinaryClass {

	public function get_data($hex)
	{

       $hex          = str_replace('#', '', $hex);

       $data['text'] = base_convert($hex, 16, 2);

       return $data;

	}
}