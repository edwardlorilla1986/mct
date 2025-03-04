<?php 

namespace App\Classes;
use App\Classes\SWTClass;

class EachConverterClass {

    private $CONVERSION_LIST = array(
        "each"  => 0.08333333333333333,
        "dozen" => 1
    );
    
	public function get_data( $from_value, $calculate_from )
	{

        try {

            $data = null;

            $swt = new SWTClass();

            $liter_value = $swt->convert_to($this->CONVERSION_LIST, $from_value, $calculate_from);

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