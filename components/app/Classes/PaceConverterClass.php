<?php 

namespace App\Classes;
use App\Classes\SWTClass;

class PaceConverterClass {

    private $CONVERSION_LIST = array(
        "minute_per_kilometer" => 1,
        "second_per_minute"    => 16.666666666666668,
        "minute_per_mile"      => 0.6213692038495188
    );
    
	public function get_data( $from_value, $convert_from )
	{

        try {

            $data = null;

            $swt = new SWTClass();

            $liter_value = $swt->convert_to($this->CONVERSION_LIST, $from_value, $convert_from);

            foreach ($this->CONVERSION_LIST as $key => $value) {
                
                $data[$key] = $swt->convert_from($this->CONVERSION_LIST, $liter_value, $key);
            }

            return $data;
            
        } catch (\Exception $e) {

            session()->flash('status', 'error');
            session()->flash('message', __($e->getMessage()));
            return;
        }

	}
    //

}