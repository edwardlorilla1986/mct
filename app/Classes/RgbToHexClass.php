<?php 

namespace App\Classes;

class RgbToHexClass {

	public function get_data($red, $green, $blue)
	{

        $red = dechex($red);
        if (strlen($red)<2)
        $red = '0'.$red;

        $green = dechex($green);
        if (strlen($green)<2)
        $green = '0'.$green;

        $blue = dechex($blue);
        if (strlen($blue)<2)
        $blue = '0'.$blue;

        $data['hex_color'] = '#' . $red . $green . $blue;

        return $data;

	}
}