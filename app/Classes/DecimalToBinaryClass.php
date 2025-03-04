<?php 

namespace App\Classes;

class DecimalToBinaryClass {

	public function get_data($number)
	{

		$data['text'] = sprintf( "%08d", decbin( $number ));

		return $data;

	}
}