<?php 

namespace App\Classes;

class NumberToRomanNumeralsClass {

    private $DATA_LIST = array(
        'M'  => 1000, 
        'CM' => 900, 
        'D'  => 500, 
        'CD' => 400, 
        'C'  => 100, 
        'XC' => 90, 
        'L'  => 50, 
        'XL' => 40, 
        'X'  => 10, 
        'IX' => 9, 
        'V'  => 5, 
        'IV' => 4, 
        'I'  => 1
    );

	public function get_data( $number )
	{
        try {

            $n = intval($number);
            
            $result = '';

            foreach ($this->DATA_LIST as $key => $value){ 

                $matches = intval($n / $value); 

                $result .= str_repeat($key, $matches); 

                $n = $n % $value; 
            }

            $data['text'] = $result;

            return $data;
            
        } catch (\Exception $e) {

            session()->flash('status', 'error');
            session()->flash('message', __($e->getMessage()));
            return;
        }

	}
    //

}