<?php 

namespace App\Classes;
use App\Classes\SWTClass;

class VolumeConverterClass {

    private $CONVERSION_LIST = array(
        "gallons"     => 3.78541,
        "quarts"      => 0.946353,
        "liters"      => 1,
        "pints"       => 0.473176,
        "cups"        => 0.24,
        "ounces"      => 0.0295735,
        "tablespoons" => 0.0147868,
        "teaspoons"   => 0.00492892,
        "milliliters" => 0.001
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