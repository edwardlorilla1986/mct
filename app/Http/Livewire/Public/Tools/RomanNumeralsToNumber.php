<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use App\Classes\RomanNumeralsToNumberClass;
use DateTime, File;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class RomanNumeralsToNumber extends Component
{

    public $text;
    public $data = [];
    public $recaptcha;

    public function render()
    {
        return view('livewire.public.tools.roman-numerals-to-number');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onRomanNumeralsToNumber
     * -------------------------------------------------------------------------------
    **/
    public function onRomanNumeralsToNumber(){

        $validationRules = [
            'text' => 'required'
        ];

        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        try {

            $output = new RomanNumeralsToNumberClass();

            $this->data = $output->get_data( $this->text );

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
        $this->text = 'XII';
    }

    /**
     * -------------------------------------------------------------------------------
     *  onReset
     * -------------------------------------------------------------------------------
    **/
    public function onReset()
    {
        $this->text = null;
        $this->data = null;
    }
}
