<?php 

namespace App\Classes;
use App\Classes\SWTClass;

class OctalToTextClass {

	public function get_data($oct)
	{

        try {

        	$swt = new SWTClass();
        	
            $binaries = explode(' ', $oct);
         	
         	$string = '';

            foreach ($binaries as $value) {

            	if ( $swt->isOctal($value) ) {

            		$binary = base_convert($value, 8, 2);

                	$string .= chr(bindec($binary));

				} else {
		            session()->flash('status', 'error');
		            session()->flash('message', __('This is not octal.'));
		            return;
				}
            }

            $data['text'] = $string;

            return $data;
            
        } catch (\Exception $e) {

            session()->flash('status', 'error');
            session()->flash('message', __($e->getMessage()));
            return;
        }

	}

}