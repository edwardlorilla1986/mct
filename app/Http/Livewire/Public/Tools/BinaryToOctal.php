<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use App\Classes\BinaryToOctalClass;
use DateTime, File;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class BinaryToOctal extends Component
{
    public $text;
    public $data = [];
    public $recaptcha;

    public function render()
    {
        return view('livewire.public.tools.binary-to-octal');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onBinaryToOctal
     * -------------------------------------------------------------------------------
    **/
    public function onBinaryToOctal(){

        $validationRules = [
            'text' => 'required',
        ];

        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        try {

            $output = new BinaryToOctalClass();

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
        $this->text = '100101110';
    }

    /**
     * -------------------------------------------------------------------------------
     *  onReset
     * -------------------------------------------------------------------------------
    **/
    public function onReset()
    {
		$this->data = null;
        $this->text = null;
        $this->data = null;
    }
}
