<?php 

namespace App\Classes;
use App\Classes\SWTClass;

class PowerConverterClass {

    private $CONVERSION_LIST = array(
        "watt"      => 1,
        "milliwatt" => 0.001,
        "kilowatt"  => 1000,
        "megawatt"  => 1000000,
        "gigawatt"  => 1000000000
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