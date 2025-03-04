<?php 

namespace App\Classes;

class HexToTextClass {

	public function get_data($hex)
	{

        try {

            $data['text'] = hex2bin($hex);

            return $data;

            
        } catch (\Exception $e) {

            session()->flash('status', 'error');
            session()->flash('message', __($e->getMessage()));
            return;
        }

	}

}