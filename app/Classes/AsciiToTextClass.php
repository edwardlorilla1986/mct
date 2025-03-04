<?php 

namespace App\Classes;

class AsciiToTextClass {

	public function get_data($text)
	{

            $characters = explode(" ", $text);

            $results = '';

            foreach ($characters as $character) {

                $results .= chr($character);
            }

            $data['text'] = $results;

            return $data;

	}
}