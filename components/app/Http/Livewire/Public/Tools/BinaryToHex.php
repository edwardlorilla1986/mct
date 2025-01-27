<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use App\Classes\BinaryToHexClass;
use DateTime, File;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class BinaryToHex extends Component
{

    public $binary;
    public $data = [];
    public $recaptcha;
    
    public function render()
    {
        return view('livewire.public.tools.binary-to-hex');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onBinaryToHex
     * -------------------------------------------------------------------------------
    **/
    public function onBinaryToHex(){

        $validationRules = [
            'binary' => 'required',
        ];

        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        try {

            $output = new BinaryToHexClass();

            $this->data = $output->get_data( $this->binary );

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
        $this->binary = '111111110000000000000000';
    }

    /**
     * -------------------------------------------------------------------------------
     *  onReset
     * -------------------------------------------------------------------------------
    **/
    public function onReset()
    {
		$this->data = null;
        $this->binary = null;
        $this->data   = null;
    }
}
