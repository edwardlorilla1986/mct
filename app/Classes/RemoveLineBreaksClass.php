<?php 

namespace App\Classes;

class RemoveLineBreaksClass {

	public function get_data($text, $para_option)
	{

        switch ( $para_option ) {
            
            case 'no_paragraphs':
                    $data['text'] = preg_replace("/\n+/", "\n", $text);
                break;
            
            default:
                    $data['text'] = preg_replace('/\s+/', ' ', $text);
                break;
        }

        return $data;

	}
}