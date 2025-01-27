<?php 

namespace App\Classes;
use App\Classes\SWTClass;

class DecimalToOctalClass {

	public function get_data($dec)
	{

        try {

        	$swt = new SWTClass();
        	
			if ( $swt->isDecimal($dec) ) {

		       $data['text'] = base_convert($dec, 10, 8);

		       return $data;

			} else {
	            session()->flash('status', 'error');
	            session()->flash('message', __('This is not a decimal number!'));
	            return;
			}
            
        } catch (\Exception $e) {

            session()->flash('status', 'error');
            session()->flash('message', __($e->getMessage()));
            return;
        }

	}

}