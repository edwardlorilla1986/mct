<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use App\Classes\BinaryToDecimalClass;
use DateTime, File;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class BinaryToDecimal extends Component
{

    public $binary;
    public $data = [];
    public $recaptcha;

    public function render()
    {
        return view('livewire.public.tools.binary-to-decimal');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onBinaryToDecimal
     * -------------------------------------------------------------------------------
    **/
    public function onBinaryToDecimal(){

        $validationRules = [
            'binary' => 'required',
        ];

        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        try {

                $output = new BinaryToDecimalClass();

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
        $this->binary = '01100011';
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
        $this->data = null;
    }
}
