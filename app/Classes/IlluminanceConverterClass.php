<?php 

namespace App\Classes;
use App\Classes\SWTClass;

class IlluminanceConverterClass {

    private $CONVERSION_LIST = array(
        "microlux"                    => 1.0e-6,
        "millilux"                    => 0.001,
        "lux"                         => 1,
        "kilolux"                     => 1000,
        "lumen_per_square_meter"      => 1,
        "lumen_per_square_centimeter" => 10000,
        "foot_candle"                 => 11.1111111,
        "phot"                        => 10000,
        "nox"                         => 0.001,
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