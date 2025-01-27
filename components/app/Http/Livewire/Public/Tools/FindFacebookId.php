<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use App\Classes\FindFacebookIDClass;
use DateTime, File;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class FindFacebookId extends Component
{
    public $link;
    public $data = [];
    public $recaptcha;

    public function render()
    {
        return view('livewire.public.tools.find-facebook-id');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onFindFacebookID
     * -------------------------------------------------------------------------------
    **/
    public function onFindFacebookID(){

        $validationRules = [
            'link' => 'required|url'
        ];

        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        try {

            $output = new FindFacebookIDClass();

            $this->data = $output->get_data( $this->link );

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
