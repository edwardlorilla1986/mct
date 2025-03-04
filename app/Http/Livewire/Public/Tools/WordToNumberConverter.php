<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use App\Classes\WordToNumberConverterClass;
use DateTime, File;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class WordToNumberConverter extends Component
{

    public $text;
    public $locale = 'en_US';
    public $data = [];
    public $recaptcha;

    public function render()
    {
        return view('livewire.public.tools.word-to-number-converter');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onWordToNumberConverter
     * -------------------------------------------------------------------------------
    **/
    public function onWordToNumberConverter(){

        $validationRules = [
            'text'   => 'required',
            'locale' => 'required'
        ];

        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        try {

            $output = new WordToNumberConverterClass();

            $this->data = $output->get_data( $this->locale, $this->text );

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
        $this->text = 'Twelve';
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
