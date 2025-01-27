<?php 

namespace App\Classes;
use App\Classes\SWTClass;

class TorqueConverterClass {

    private $CONVERSION_LIST = array(
        "dyne_centimeter" => 1,
        "kgrf_meter"      => 98066500,
        "newton_meter"    => 10000000,
        "lbf_foot"        => 13558180,
        "lbf_inch"        => 1129848,
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