<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use App\Classes\CaseConverterClass;
use DateTime, File;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class CaseConverter extends Component
{
    public $text;
    public $data = [];
    public $recaptcha;

    public function render()
    {
        return view('livewire.public.tools.case-converter');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onTextToSlug
     * -------------------------------------------------------------------------------
    **/
    public function onSentenceCase()
    {
        $validationRules = [
            'text' => 'required',
        ];

        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        try {

            $output = new CaseConverterClass();

            $this->data = $output->get_data( $this->text, 'sentenceCase' );

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
     *  onLowerCase
     * -------------------------------------------------------------------------------
    **/
    public function onLowerCase()
    {
        $validationRules = [
            'text' => 'required',
        ];

        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        try {

            $output = new CaseConverterClass();

            $this->data = $output->get_data( $this->text, 'lowerCase' );

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
     *  onUpperCase
     * -------------------------------------------------------------------------------
    **/
    public function onUpperCase()
    {
        $validationRules = [
            'text' => 'required',
        ];

        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        try {

            $output = new CaseConverterClass();

            $this->data = $output->get_data( $this->text, 'upperCase' );

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
     *  onCapitalizedCase
     * -------------------------------------------------------------------------------
    **/
    public function onCapitalizedCase()
    {
        $validationRules = [
            'text' => 'required',
        ];

        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        try {

            $output = new CaseConverterClass();

            $this->data = $output->get_data( $this->text, 'capitalizedCase' );

            $this->dispatchBrowserEvent('resetReCaptcha');

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        if ( !empty($this->data) ) {

          
        }
    }

}
