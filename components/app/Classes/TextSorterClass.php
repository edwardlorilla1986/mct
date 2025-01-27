<?php 

namespace App\Classes;
use Illuminate\Support\Str;

class TextSorterClass {

    public function get_data($text, $sorting_options, $remove_duplicates)
    {
        // Split the text into lines
        $words = explode("\n", trim($text));

        // Remove duplicates if required
        if ($remove_duplicates) {
            $words = array_intersect_key(
                $words,
                array_unique(array_map("mb_strtolower", $words))
            );
        }

        // Sort based on the given option
        switch ($sorting_options) {
            case 'az':
                    natcasesort($words);
                    $words = array_values($words);
                break;
            case 'za':
                    natcasesort($words);
                    $words = array_reverse($words);
                break;
            case 'reverse':
                    $words = array_reverse($words);
                break;
            case 'randomize':
                    shuffle($words);
                break;
            default:
                // By default, do not sort; just use the order from the text
                break;
        }

        // Combine the words back to a single string
        $data['text'] = implode("\n", $words);

        return $data;
    }
    
}