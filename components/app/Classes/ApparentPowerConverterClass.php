<?php 

namespace App\Classes;
use App\Classes\SWTClass;

class ApparentPowerConverterClass {

    private $CONVERSION_LIST = array(
        "volt"      => 1,
        "millivolt" => 0.001,
        "kilovolt"  => 1000,
        "megavolt"  => 1000000,
        "gigavolt"  => 1000000000
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