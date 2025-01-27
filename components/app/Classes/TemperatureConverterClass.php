<?php 

namespace App\Classes;

class TemperatureConverterClass {

	public function get_data( $from_value, $convert_from )
	{

        try {

            $data = null;

            switch ($convert_from) {

                case 'celsius':
                        $data = $this->fromCelsiusToOthers($from_value);
                    break;

                case 'kelvin':
                        $data = $this->fromKelvinToOthers($from_value);
                    break;

                case 'fahrenheit':
                        $data = $this->fromFahrenheitToOthers($from_value);
                    break;

                default:
                     $data = $this->fromCelsiusToOthers($from_value);
                    break;
            }

            return $data;
            
        } catch (\Exception $e) {

            session()->flash('status', 'error');
            session()->flash('message', __($e->getMessage()));
            return;
        }

	}

    private function fromCelsiusToOthers($value){

        $value             = floatval($value);

        $data['celsius']     = $value;

        $data['kelvin']      = $value + 273.15;

        $data['fahrenheit']  = ($value * 1.8) + 32;

        return $data;

    }

    private function fromKelvinToOthers($value){

        $value             = floatval($value);

        $data['celsius']     = $value - 273.15;

        $data['kelvin']      = $value;

        $data['fahrenheit']  = (($value - 273.15) * 1.8) + 32;

        return $data;

    }

    private function fromFahrenheitToOthers($value){

        $value             = floatval($value);

        $data['celsius']     = ($value - 32) / 1.8;

        $data['kelvin']      = (($value - 32) / 1.8) + 273.15;

        $data['fahrenheit']  = $value;

        return $data;

    }

    //

}