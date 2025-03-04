<?php 

namespace App\Classes;
use App\Classes\SWTClass;

class WeightConverterClass {

    private $CONVERSION_LIST = array(
        "pound"     => 0.453592,
        "gram"      => 0.001,
        "kilogram"  => 1,
        "ounce"     => 0.0283495,
        // "stone"     => 157.473,
        "carrat"    => 0.0002,
        "milligram" => 0.000001,
        "metric"    => 1000
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