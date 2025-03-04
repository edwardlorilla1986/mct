<?php 

namespace App\Classes;

class TextToAsciiClass {

	public function get_data($text)
	{

                $characters = mb_str_split($text);

                $results = [];

                foreach ($characters as $character) {

                    for ($pos = 0; $pos < strlen($character); $pos++) {

                        $byte = substr($character, $pos);

                        $results[] = ord($byte);
                    }
                }

                $data['text'] = implode(' ', $results);

                return $data;

	}
}