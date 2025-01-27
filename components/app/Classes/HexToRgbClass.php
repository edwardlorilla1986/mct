<?php 

namespace App\Classes;

class HexToRgbClass {

	public function get_data($hex)
	{

       $hex      = str_replace('#', '', $hex);

       $length   = strlen($hex);

       $data['red'] = hexdec($length == 6 ? substr($hex, 0, 2) : ($length == 3 ? str_repeat(substr($hex, 0, 1), 2) : 0));

       $data['green'] = hexdec($length == 6 ? substr($hex, 2, 2) : ($length == 3 ? str_repeat(substr($hex, 1, 1), 2) : 0));

       $data['blue'] = hexdec($length == 6 ? substr($hex, 4, 2) : ($length == 3 ? str_repeat(substr($hex, 2, 1), 2) : 0));

       return $data;

	}
}