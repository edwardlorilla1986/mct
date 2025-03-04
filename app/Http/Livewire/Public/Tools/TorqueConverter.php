<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use App\Classes\TorqueConverterClass;
use DateTime, File;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class TorqueConverter extends Component
{

    public $from_value;
    public $convert_from = 'dyne_centimeter';
    public $from_name;
    public $recaptcha;
    public $data = [];

    public function render()
    {
        return view('livewire.public.tools.torque-converter');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onTorqueConverter
     * -------------------------------------------------------------------------------
    **/
    public function onTorqueConverter(){

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

            $output = new TorqueConverterClass();

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
