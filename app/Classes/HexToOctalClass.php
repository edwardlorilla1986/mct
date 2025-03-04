<?php 

namespace App\Classes;
use App\Classes\SWTClass;

class HexToOctalClass {

	public function get_data($hex)
	{

        try {

        	$swt = new SWTClass();
        	
			if ( $swt->isHexadecimal($hex) ) {

		       $data['text'] = base_convert($hex, 16, 8);

		       return $data;

			} else {
	            session()->flash('status', 'error');
	            session()->flash('message', __('This is not a hexadecimal number!'));
	            return;
			}
            
        } catch (\Exception $e) {

            session()->flash('status', 'error');
            session()->flash('message', __($e->getMessage()));
            return;
        }

	}

}