<?php 

namespace App\Classes;
use Illuminate\Support\Str;

class CommaSeparatorClass {

    public function get_data($text, $delimiter)
    {
        // Split the text into lines
        $lines = explode("\n", trim($text));
        
        // Combine the words back to a single string
        $data['text'] = implode($delimiter, $lines);

        return $data;
    }
    
}