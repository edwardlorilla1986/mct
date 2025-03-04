<?php 

namespace App\Classes;

class TextToDecimalClass {

	public function get_data($text)
	{

        try {

            $characters = str_split($text);

            $dec = [];

            foreach ($characters as $character) {

                    $data = unpack('H*', $character);

                    $ret = base_convert($data[1], 16, 2);

                    $dec[] = ( strlen($ret) < 8 ) ? bindec(str_repeat("0", 8 - strlen($ret)) . $ret) : bindec($ret);

            }

            $data['text'] = implode(' ', $dec);

            return $data;

            
        } catch (\Exception $e) {

            session()->flash('status', 'error');
            session()->flash('message', __($e->getMessage()));
            return;
        }

	}

}