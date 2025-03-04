<?php 

namespace App\Classes;
use App\Classes\SWTClass;

class PartsPerConverterClass {

    private $CONVERSION_LIST = array(
        "ppm" => 1,
        "ppb" => 0.001,
        "ppt" => 0.000001,
        "ppq" => 1.0e-9
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