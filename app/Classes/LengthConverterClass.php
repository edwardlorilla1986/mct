<?php 

namespace App\Classes;

class LengthConverterClass {

    private $CONVERSION_LIST = array(
        "meter"      => 1,
        "kilometer"  => 1000,
        "centimeter" => 0.01,
        "millimeter" => 0.001,
        "micrometer" => 0.000001,
        "nanometer"  => 0.000000001,
        "mile"       => 1609.35,
        "yard"       => 0.9144,
        "foot"       => 0.3048,
        "inch"       => 0.0254,
        "light_year" => 9.46066e+15
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