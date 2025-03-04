<?php 

namespace App\Classes;

class TextToBinaryClass {

	public function get_data($text)
	{

                $characters = str_split($text);

                $binary = [];

                foreach ($characters as $character) {

                        $data = unpack('H*', $character);

                        $ret = base_convert($data[1], 16, 2);

                        $binary[] = ( strlen($ret) < 8 ) ? str_repeat("0", 8 - strlen($ret)) . $ret : $ret;

                }

                $data['text'] = implode(' ', $binary);

                return $data;

	}
}