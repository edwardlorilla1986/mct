<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use App\Classes\UrlDecodeClass;
use DateTime, File;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class UrlDecode extends Component
{

    public $url;
    public $data = [];
    public $recaptcha;

    public function render()
    {
        return view('livewire.public.tools.url-decode');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onUrlDecode
     * -------------------------------------------------------------------------------
    **/
    public function onUrlDecode(){

        $validationRules = [
            'url' => 'required'
        ];

        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        try {

            $output = new UrlDecodeClass();

            $this->data = $output->get_data( $this->url );

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
        $this->url = 'https%3A%2F%2Fgoogle.com';
    }

    /**
     * -------------------------------------------------------------------------------
     *  onReset
     * -------------------------------------------------------------------------------
    **/
    public function onReset()
    {
        $this->url   = null;
        $this->data  = [];
    }
}
