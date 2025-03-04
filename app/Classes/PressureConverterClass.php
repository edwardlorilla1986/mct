<?php 

namespace App\Classes;
use App\Classes\SWTClass;

class PressureConverterClass {

    private $CONVERSION_LIST = array(
        "pascal"                    => 1,
        "kilopascal"                => 1000,
        "megapascal"                => 1000000,
        "hectopascal"               => 100,
        "bar"                       => 100000,
        "torr"                      => 133.32236842105263,
        "pound_per_square_inch"     => 6894.76000045014,
        "kilopound_per_square_inch" => 6894760.00045014
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