<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use App\Classes\CssMinifierClass;
use DateTime, File;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class CssMinifier extends Component
{
    public $code;
    public $data = [];
    public $recaptcha;
    public function render()
    {
        return view('livewire.public.tools.css-minifier');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onCssMinifier
     * -------------------------------------------------------------------------------
    **/
    public function onCssMinifier(){

        $validationRules = [
            'code'       => 'required'
        ];

        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        try {

            $output = new CssMinifierClass();

            $this->data = $output->get_data( $this->code );

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
        $this->code = <<<EOT
body {
    font-family: "Arial", sans-serif;
    background-color: #f9f9f9;
    color: #333;
    line-height: 1.6;
}

header {
    background-color: #333;
    color: #fff;
    padding: 20px 0;
    text-align: center;
}

footer {
    text-align: center;
    padding: 20px 0;
    background-color: #333;
    color: #fff;
}
EOT;
    }

    /**
     * -------------------------------------------------------------------------------
     *  onReset
     * -------------------------------------------------------------------------------
    **/
    public function onReset()
    {
        $this->code = null;
        $this->data = [];
    }
}
