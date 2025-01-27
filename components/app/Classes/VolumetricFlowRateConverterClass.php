<?php 

namespace App\Classes;
use App\Classes\SWTClass;

class VolumetricFlowRateConverterClass {

    private $CONVERSION_LIST = array(
        "cubic_kilometers_per_second"  => 1000000000,
        "cubic_meters_per_second"      => 1,
        "cubic_decimeters_per_second"  => 0.001,
        "cubic_centimetres_per_second" => 1.0e-6,
        "cubic_millimeters_per_second" => 1.0e-9,
        "cubic_inches_per_second"      => 1.63870651e-5,
        "cubic_feet_per_second"        => 0.0283205891,
        "gallons_per_second_us_liquid" => 0.00378544119,
        "gallons_per_second_imperial"  => 0.00454607446,
        "liters_per_second"            => 0.001,
        "cubic_miles_per_second"       => 4.16666667e9,
        "acre_feet_per_second"         => 1.23304562e-5,
        "bushels_per_second_us"        => 0.0352360817,
        "bushels_per_second_imperial"  => 0.0363636364,
        "cubic_kilometers_per_minute"  => 1.66666667e-9,
        "cubic_meters_per_minute"      => 0.0166666667,
        "cubic_decimeters_per_minute"  => 1.66666667e-5,
        "cubic_centimetres_per_minute" => 1.66666667e-8,
        "cubic_millimeters_per_minute" => 1.66666667e-11,
        "cubic_inches_per_minute"      => 2.73117733e-7,
        "cubic_feet_per_minute"        => 0.000471947444,
        "gallons_per_minute_us_liquid" => 6.30902089e-5,
        "gallons_per_minute_imperial"  => 7.57681948e-5,
        "liters_per_minute"            => 1.66666667e-5,
        "cubic_miles_per_minute"       => 6.94444444e-9,
        "acre_feet_per_minute"         => 20,
        "bushels_per_minute_us"        => 0.000587316317,
        "bushels_per_minute_imperial"  => 0.000606145099,

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