<?php 

namespace App\Classes;
use App\Classes\SWTClass;

class ChargeConverterClass {

    private $CONVERSION_LIST = array(
        "coulomb"       => 1,
        "megacoulomb"   => 1000000,
        "kilocoulomb"   => 1000,
        "millicoulomb"  => 0.001,
        "microcoulomb"  => 1.0e-6,
        "nanocoulomb"   => 1.0e-9,
        "picocoulomb"   => 1.0e-12,
        "abcoulomb"     => 10,
        "emu"           => 10,
        "statcoulomb"   => 3.33564095e-10,
        "esu"           => 3.33564095e-10,
        "franklin"      => 3.33564095e-10,
        "ampere_hour"   => 3599.99971,
        "ampere_minute" => 59.9999999,
        "ampere_second" => 1,
        "faraday"       => 96485.0496,
        "elementary"    => 1.60217733e-19,
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