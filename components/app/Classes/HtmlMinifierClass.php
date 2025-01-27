<?php 

namespace App\Classes;
require_once __DIR__ . "/Modules/TinyHtmlMinifier.php";
use App\Classes\Modules\TinyHtmlMinifier;

class HtmlMinifierClass {

	public function get_data($code)
	{

        $minifier = new TinyHtmlMinifier([
							'collapse_whitespace' => true,
							'disable_comments'    => false,
						]);

		$data['code'] = $minifier->minify($code);
		
        return $data;
	}
}