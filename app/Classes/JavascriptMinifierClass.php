<?php 

namespace App\Classes;
require_once __DIR__ . "/Modules/packer.php";
use App\Classes\Modules\Packer;

class JavascriptMinifierClass {

	public function get_data($code)
	{
        $packer = new Packer($code, 'None', true, false, true);

        $data['code'] = $packer->pack();

        return $data;
	}
}