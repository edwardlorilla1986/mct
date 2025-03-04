<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use App\Classes\IpAddressLookupClass;
use DateTime, File;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class IpAddressLookup extends Component
{
    public $ip;
    public $data = [];
    public $recaptcha;

    public function render()
    {
        return view('livewire.public.tools.ip-address-lookup');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onIpAddressLookup
     * -------------------------------------------------------------------------------
    **/
    public function onIpAddressLookup(){

        $validationRules = [
            'ip' => 'required|ip'
        ];

        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        try {

            $output = new IpAddressLookupClass();

            $this->data = $output->get_data( $this->ip );

            $this->dispatchBrowserEvent('resetReCaptcha');

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        if ( !empty($this->data) ) {

            
        }

    }
    //
}
