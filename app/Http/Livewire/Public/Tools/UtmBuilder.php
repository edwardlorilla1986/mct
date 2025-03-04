<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use DateTime;
use App\Classes\UtmBuilderClass;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class UtmBuilder extends Component
{

    public $link;
    public $utm_source;
    public $utm_medium;
    public $utm_campaign;
    public $utm_content;
    public $utm_term;
    public $data = [];

    public $recaptcha;

    public function render()
    {
        return view('livewire.public.tools.utm-builder');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onUtmBuilder
     * -------------------------------------------------------------------------------
    **/
    public function onUtmBuilder(){

        $validationRules = [
            'link'         => 'required',
            'utm_source'   => 'required',
            'utm_medium'   => 'required',
            'utm_campaign' => 'required',
            'utm_content'  => 'required',
            'utm_term'     => 'required'
        ];

        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        try {

            $output = new UtmBuilderClass();

            $this->data = $output->get_data($this->link, $this->utm_source, $this->utm_medium, $this->utm_campaign, $this->utm_content, $this->utm_term);

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
        $this->link         = url('/');
        $this->utm_source   = 'google';
        $this->utm_medium   = 'social';
        $this->utm_campaign = 'promotion';
        $this->utm_content  = 'buy-now';
        $this->utm_term     = 'Hello';
    }

    /**
     * -------------------------------------------------------------------------------
     *  onReset
     * -------------------------------------------------------------------------------
    **/
    public function onReset()
    {
        $this->data         = [];
        $this->link         = null;
        $this->utm_source   = null;
        $this->utm_medium   = null;
        $this->utm_campaign = null;
        $this->utm_content  = null;
        $this->utm_term     = null;
    }
}
