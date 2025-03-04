<?php 

namespace App\Classes;

class DecimalToTextClass {

	public function get_data($dec)
	{

        try {

            $binaries = explode(' ', $dec);
         
            $string = '';

            foreach ($binaries as $value) {
                
                $binary = sprintf( "%08d", decbin( $value ));

                $string .= chr(bindec($binary));
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