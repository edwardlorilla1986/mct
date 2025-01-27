<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use App\Classes\HtmlBeautifierClass;
use DateTime, File;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class HtmlBeautifier extends Component
{

    public $code;
    public $data = [];
    public $recaptcha;

    public function render()
    {
        return view('livewire.public.tools.html-beautifier');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onHtmlBeautifier
     * -------------------------------------------------------------------------------
    **/
    public function onHtmlBeautifier(){

        $validationRules = [
            'code' => 'required'
        ];

        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        try {

            $output = new HtmlBeautifierClass();

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
        $this->code = '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Personal Profile</title></head><body><header><h1>Jane Doe</h1><p>Web Developer</p></header><main><section><h2>About Me</h2><p>Hello! I am Jane, a passionate web developer with over 5 years of experience. I love creating responsive and user-friendly websites.</p></section></main><footer><p>Thank you for visiting my profile!</p></footer></body></html>';
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
