<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use App\Classes\EachConverterClass;
use DateTime, File;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class EachConverter extends Component
{

    public $from_value;
    public $convert_from = 'each';
    public $from_name;
    public $recaptcha;
    public $data = [];

    public function render()
    {
        return view('livewire.public.tools.each-converter');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onEachConverter
     * -------------------------------------------------------------------------------
    **/
    public function onEachConverter(){

        $validationRules = [
            'from_value'   => 'required|numeric|gt:0',
            'convert_from' => 'required'
        ];

        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        try {

            $output = new EachConverterClass();

            $this->data = $output->get_data( $this->from_value, $this->convert_from );
            
            $this->from_name = ucfirst($this->convert_from);

            $this->dispatchBrowserEvent('resetReCaptcha');

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        if ( !empty($this->data) ) {

           
        }

    }

    /**
     * -------------------------------------------------------------------------------
     *  onSample
     * -------------------------------------------------------------------------------
    **/
    public function onSample()
    {
        $this->from_value = 12;
    }

    /**
     * -------------------------------------------------------------------------------
     *  onReset
     * -------------------------------------------------------------------------------
    **/
    public function onReset()
    {
        $this->from_value = null;
        $this->data       = null;
    }
}
