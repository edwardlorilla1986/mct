<?php 

namespace App\Classes;
use App\Classes\SWTClass;

class BinaryToOctalClass {

	public function get_data($bin)
	{

        try {

        	$swt = new SWTClass();
        	
			if ( $swt->isBinary($bin) ) {

		       $data['text'] = base_convert($bin, 2, 8);

		       return $data;

			} else {
	            session()->flash('status', 'error');
	            session()->flash('message', __('This is not a binary number!'));
	            return;
			}
            
        } catch (\Exception $e) {

            session()->flash('status', 'error');
            session()->flash('message', __($e->getMessage()));
            return;
        }

	}

}