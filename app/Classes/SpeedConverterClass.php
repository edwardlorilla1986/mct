<?php 

namespace App\Classes;
use App\Classes\SWTClass;

class SpeedConverterClass {

    private $CONVERSION_LIST = array(
        "meter_per_second"   => 1,
        "kilometre_per_hour" => 0.2777777778,
        "mile_per_hour"      => 0.44704,
        "knot"               => 0.5144444444,
        "foot_per_hour"      => 8.46667E-5,
        "foot_per_minute"    => 0.00508,
        "foot_per_second"    => 0.3048
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