<?php 

namespace App\Classes;

class BinaryToDecimalClass {

	public function get_data($bin)
	{

		$data['text'] = bindec( $bin );

		return $data;

	}
}