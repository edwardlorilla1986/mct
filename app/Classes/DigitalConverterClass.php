<?php 

namespace App\Classes;
use App\Classes\SWTClass;

class DigitalConverterClass {

    private $CONVERSION_LIST = array(
        "bit"       => 1,
        "byte"      => 8,
        "kilobyte"  => 8192,
        "megabyte"  => 8388608,
        "gigabyte"  => 8589934592,
        "terabyte"  => 8796093022208,
        "petabyte"  => 9.007199254741E+15,
        "exabyte"   => 1.4411518807586E+17,
        "zettabyte" => 1.4757395258968E+20,
        "yottabyte" => 1.5111572745183E+23
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