<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use App\Classes\PasswordGeneratorClass;
use DateTime, File;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class PasswordGenerator extends Component
{

    public $password_length = 6;
    public $uppercase = true;
    public $lowercase = true;
    public $numbers   = true;
    public $symbols   = true;
    public $recaptcha;
    public $data = [];

    public function render()
    {
        return view('livewire.public.tools.password-generator');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onPasswordGenerator
     * -------------------------------------------------------------------------------
    **/
    public function onPasswordGenerator(){

        $validationRules = [];
        
        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        if (!empty($validationRules)) {
            $this->validate($validationRules);
        }
        
        $this->data = null;

        try {

            $output = new PasswordGeneratorClass();

            $this->data = $output->get_data($this->password_length, $this->uppercase, $this->lowercase, $this->numbers, $this->symbols);

            $this->dispatchBrowserEvent('resetReCaptcha');

        } catch (\Exception $e) {
            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        if ( !empty($this->data) ) {

        }
        //

    }

}
