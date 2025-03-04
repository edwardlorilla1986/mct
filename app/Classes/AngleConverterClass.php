<?php 

namespace App\Classes;
use App\Classes\SWTClass;

class AngleConverterClass {

    private $CONVERSION_LIST = array(
        "radian"     => 57.29578,
        "degree"     => 1,
        "minutes"    => 0.016667,
        "seconds"    => 2.777778e-4,
        "sign"       => 30,
        "octant"     => 45,
        "sextant"    => 60,
        "quadrant"   => 90,
        "revolution" => 360,
        "gon"        => 0.9,
        "mil"        => 0.05625,
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