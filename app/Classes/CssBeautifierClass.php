<?php 

namespace App\Classes;
use Sabberworm\CSS\Parser;
use Sabberworm\CSS\OutputFormat;

class CssBeautifierClass {

	public function get_data($code)
	{
	    // Parse the input CSS code
	    $parser = new Parser($code);
	    
	    $parsed_css = $parser->parse();

	    // Define the output format
	    $output_format = OutputFormat::createPretty()->setSpaceBetweenRules("\n");

	    // Format the parsed CSS
	    $formatted_css = $parsed_css->render($output_format);

	    $data['code'] = $formatted_css;

	    return $data;
	}

}