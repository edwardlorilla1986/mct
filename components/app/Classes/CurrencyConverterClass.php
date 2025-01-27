<?php 

namespace App\Classes;
use App\Classes\SWTClass;

class CurrencyConverterClass {

    private $CONVERSION_LIST = array(
        "EUR" => 1,
        "USD" => 0.932835821,
        "GBP" => 1.16618076,
        "INR" => 0.0120213981,
        "AUD" => 0.659978881,
        "CAD" => 0.729181858,
        "JPY" => 0.00732654407,
        "BGN" => 0.511299724,
        "BRL" => 0.193076284,
        "CHF" => 0.967679505,
        "CNY" => 0.139959971,
        "CZK" => 0.0405465677,
        "DKK" => 0.134388733,
        "HKD" => 0.118845299,
        "HRK" => 0.132828585,
        "HUF" => 0.00260871834,
        "IDR" => 6.36461073e-5,
        "ILS" => 0.27895559,
        "KRW" => 0.000738743397,
        "LTL" => 1,
        "LVL" => 1,
        "MXN" => 0.0470685695,
        "MYR" => 0.212422466,
        "NOK" => 0.097191175,
        "NZD" => 0.600384246,
        "PHP" => 0.0178088047,
        "PLN" => 0.217320439,
        "RON" => 0.202240828,
        "RUB" => 1,
        "SEK" => 0.0952263053,
        "SGD" => 0.679255536,
        "THB" => 0.0273156874,
        "TRY" => 0.057946828,
        "ZAR" => 0.0595897839,
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