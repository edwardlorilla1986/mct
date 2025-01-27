<?php 

namespace App\Classes;

class TextToHexClass {

	public function get_data($text)
	{

        try {

            $hex = unpack('H*', $text);

            $data['text'] = array_shift($hex);

            return $data;

        } catch (\Exception $e) {

            session()->flash('status', 'error');
            session()->flash('message', __($e->getMessage()));
            return;
        }

	}

}