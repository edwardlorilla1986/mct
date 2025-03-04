<?php 

namespace App\Classes;
use NumberFormatter;

class WordToNumberConverterClass {

	public function get_data( $locale, $text )
	{

        try {

            $text = strtolower($text);

            $formatter = numfmt_create($locale, NumberFormatter::SPELLOUT);

            $value = numfmt_parse($formatter, $text);

            $data['text'] = $value;

            return $data;
            
        } catch (\Exception $e) {

            session()->flash('status', 'error');
            session()->flash('message', __($e->getMessage()));
            return;
        }

	}
    //

}