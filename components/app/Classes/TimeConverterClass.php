<?php 

namespace App\Classes;
use App\Classes\SWTClass;

class TimeConverterClass {

    private $CONVERSION_LIST = array(
        "second"      => 1,
        "millisecond" => 0.001,
        "microsecond" => 0.000001,
        "nanosecond"  => 0.000000001,
        "picosecond"  => 0.000000000001,
        "minute"      => 60,
        "hour"        => 3600,
        "day"         => 86400,
        "week"        => 604800,
        "month"       => 2629800,
        "year"        => 31557600
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