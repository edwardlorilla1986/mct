<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use App\Classes\JavascriptObfuscatorClass;
use DateTime, File;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class JavascriptObfuscator extends Component
{

    public $code;
    public $data = [];
    public $recaptcha;

    public function render()
    {
        return view('livewire.public.tools.javascript-obfuscator');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onJavascriptObfuscator
     * -------------------------------------------------------------------------------
    **/
    public function onJavascriptObfuscator(){

        $validationRules = [
            'code' => 'required'
        ];

        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        try {

            $output = new JavascriptObfuscatorClass();

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
function NewObject(prefix)
{
    var count=0;
    this.SayHello=function(msg)
    {
          count++;
          alert(prefix+msg);
    }
    this.GetCount=function()
    {
          return count;
    }
}
var obj=new NewObject("Message : ");
obj.SayHello("You are welcome.");      
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
