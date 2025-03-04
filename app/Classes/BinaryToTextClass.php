<?php 

namespace App\Classes;

class BinaryToTextClass {

	public function get_data($binary)
	{

        try {
            
            $binaries = explode(' ', $binary);
         
            $string = '';

            foreach ($binaries as $value) {
                $string .= chr(bindec($value));
            }

            $data['text'] = $string;

            return $data;

        } catch (\Exception $e) {
            
        }


	}
}