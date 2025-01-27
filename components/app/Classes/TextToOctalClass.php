<?php 

namespace App\Classes;

class TextToOctalClass {

	public function get_data($text)
	{

        try {

            $characters = str_split($text);

            $oct = [];

            foreach ($characters as $character) {

                    $data = unpack('H*', $character);

                    $ret = base_convert($data[1], 16, 2);

                    $oct[] = ( strlen($ret) < 8 ) ? base_convert(str_repeat("0", 8 - strlen($ret)) . $ret, 2, 8) : base_convert($ret, 2, 8);

            }

            $data['text'] = implode(' ', $oct);

            return $data;

            
        } catch (\Exception $e) {

            session()->flash('status', 'error');
            session()->flash('message', __($e->getMessage()));
            return;
        }

	}

}