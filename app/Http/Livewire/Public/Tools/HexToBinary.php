<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use App\Classes\HexToBinaryClass;
use DateTime, File;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class HexToBinary extends Component
{

    public $hex_color;
    public $data = [];
    public $recaptcha;

    public function render()
    {
        return view('livewire.public.tools.hex-to-binary');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onHexToBinary
     * -------------------------------------------------------------------------------
    **/
    public function onHexToBinary(){

        $validationRules = [
            'hex_color' => 'required'
        ];

        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        try {

            $output = new HexToBinaryClass();

            $this->data = $output->get_data( $this->hex_color );

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
        $this->hex_color = 'FF0000';
    }

    /**
     * -------------------------------------------------------------------------------
     *  onReset
     * -------------------------------------------------------------------------------
    **/
    public function onReset()
    {
        $this->hex_color = null;
        $this->data      = null;
    }
}
