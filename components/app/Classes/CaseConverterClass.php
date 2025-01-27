<?php 

namespace App\Classes;

class CaseConverterClass {

	public function get_data($text, $option)
	{

        switch ( $option ) {

            case 'sentenceCase':
                   $data['text'] = ucfirst(strtolower($text));
                break;

            case 'lowerCase':
                   $data['text'] = mb_convert_case($text, MB_CASE_LOWER, "UTF-8");
                break;

            case 'upperCase':
                   $data['text'] = mb_convert_case($text, MB_CASE_UPPER, "UTF-8");
                break;

              case 'capitalizedCase':
                   $data['text'] = mb_convert_case($text, MB_CASE_TITLE, "UTF-8");
                break;

            default:
                break;
        }

        return $data;

	}
}