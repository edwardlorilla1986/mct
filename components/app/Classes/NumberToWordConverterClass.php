<?php 

namespace App\Classes;
use NumberFormatter;

class NumberToWordConverterClass {

    public function get_data( $locale, $text )
    {

        try {

            $formatter = numfmt_create($locale, NumberFormatter::SPELLOUT);

            $value = numfmt_format($formatter, $text);

            $data['text'] = ucwords($value);

            return $data;
            
        } catch (\Exception $e) {

            session()->flash('status', 'error');
            session()->flash('message', __($e->getMessage()));
            return;
        }

    }
    //

}