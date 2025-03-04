<?php 

namespace App\Classes;
require_once __DIR__ . "/Modules/beautify-html.php";
use App\Classes\Modules\Beautify_Html;

class HtmlBeautifierClass {

	public function get_data($code)
	{

		$beautify = new Beautify_Html(array(
			'indent_inner_html'     => false,
			'indent_char'           => " ",
			'indent_size'           => 2,
			'wrap_line_length'      => 32786,
			'unformatted'           => ['code', 'pre'],
			'preserve_newlines'     => false,
			'max_preserve_newlines' => 32786,
			'indent_scripts'        => 'normal' // keep|separate|normal
		));

		$data['code'] = $beautify->beautify($code);

        return $data;
	}
}