<?php 

namespace App\Classes;

class Md5GeneratorClass {

	public function get_data($text)
	{

        $data['text'] = md5($text);

        return $data;

	}
}