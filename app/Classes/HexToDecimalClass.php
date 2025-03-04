<?php 

namespace App\Classes;

class HexToDecimalClass {

	public function get_data($text)
	{

       $text          = str_replace('#', '', $text);

       $data['text'] = hexdec($text);

       return $data;

	}
}