<?php 

namespace App\Classes;
use App\Classes\SWTClass;

class AreaConverterClass {

    private $CONVERSION_LIST = array(
        "meter"      => 1,
        "kilometer"  => 1000000,
        "centimeter" => 0.0001,
        "millimeter" => 0.000001,
        "micrometer" => 0.000000000001,
        "hectare"    => 10000,
        "mile"       => 2589990,
        "yard"       => 0.83612736,
        "foot"       => 0.09290304,
        "inch"       => 0.000645160,
        "acre"       => 4046.8564224
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