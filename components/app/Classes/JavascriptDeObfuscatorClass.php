<?php 

namespace App\Classes;
use JavascriptUnpacker\JavascriptUnpacker;

class JavascriptDeObfuscatorClass {

	public function get_data($code)
	{

		$unpacker = new JavascriptUnpacker;

        $data['code'] = $unpacker->unpack($code);

        return $data;

	}
}