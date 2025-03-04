<?php 

namespace App\Classes;
use Illuminate\Support\Str;

class TextRepeaterClass {

	public function get_data($text, $repetitions, $text_between_repetitions, $newline)
	{

        $result = '';

        for ($i = 0; $i < $repetitions; $i++) {
            $result .= $text;

            // If it's not the last repetition, add the text between repetitions
            if ($i < $repetitions - 1) {
                $result .= $text_between_repetitions;

                // If newline is true, append a newline character
                if ($newline) {
                    $result .= "\n";
                }
            }
        }

        $data['text'] = $result;

        return $data;

	}
}