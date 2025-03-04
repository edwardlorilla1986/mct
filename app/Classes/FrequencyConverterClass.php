<?php 

namespace App\Classes;
use App\Classes\SWTClass;

class FrequencyConverterClass {

    private $CONVERSION_LIST = array(
        "millihertz"          => 1,
        "hertz"               => 1000,
        "kilohertz"           => 1000000,
        "megahertz"           => 1000000000,
        "gigahertz"           => 1000000000000,
        "terahertz"           => 1000000000000000,
        "rotation_per_minute" => 16.666666666666668,
        "degree_per_second"   => 2.7777777777777777,
        "radian_per_second"   => 159.15494309189535,
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