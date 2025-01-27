<?php 

namespace App\Classes;
use App\Classes\SWTClass;

class OctalToDecimalClass {

	public function get_data($oct)
	{

        try {

        	$swt = new SWTClass();
        	
			if ( $swt->isOctal($oct) ) {

		       $data['text'] = base_convert($oct, 8, 10);

		       return $data;

			} else {
	            session()->flash('status', 'error');
	            session()->flash('message', __('This is not an octal number!'));
	            return;
			}
            
        } catch (\Exception $e) {

            session()->flash('status', 'error');
            session()->flash('message', __($e->getMessage()));
            return;
        }

	}

}