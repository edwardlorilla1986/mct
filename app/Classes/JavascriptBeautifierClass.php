<?php 

namespace App\Classes;
require_once __DIR__ . "/Modules/JSBeautify.php";
use App\Classes\Modules\JSBeautify;

class JavascriptBeautifierClass {

	public function get_data($code)
	{

		$obj = new JSBeautify($code);

		$data['code'] = $obj->getResult();

        return $data;
	}
}