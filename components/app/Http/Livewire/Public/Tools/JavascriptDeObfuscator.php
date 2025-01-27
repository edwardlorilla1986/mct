<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use App\Classes\JavascriptDeObfuscatorClass;
use DateTime, File;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class JavascriptDeObfuscator extends Component
{

    public $code;
    public $data = [];
    public $recaptcha;

    public function render()
    {
        return view('livewire.public.tools.javascript-de-obfuscator');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onJavascriptDeObfuscator
     * -------------------------------------------------------------------------------
    **/
    public function onJavascriptDeObfuscator(){

        $validationRules = [
            'code' => 'required'
        ];

        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        try {

            $output = new JavascriptDeObfuscatorClass();

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
    public function onSample() {

        $this->code = 'eval(function(p,a,c,k,e,d){e=function(c){return c.toString(36)};if(!\'\'.replace(/^/,String)){while(c--){d[c.toString(a)]=k[c]||c.toString(a)}k=[function(e){return d[e]}];e=function(){return\'\\\\w+\'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp(\'\\\\b\'+e(c)+\'\\\\b\',\'g\'),k[c])}}return p}(\'2 5(9){6 1=0;7.3=2(8){1++;h(9+8)}7.g=2(){f 1}}6 4=e 5("d : ");4.3("c b a.");\',18,18,\'|count|function|SayHello|obj|NewObject|var|this|msg|prefix|welcome|are|You|Message|new|return|GetCount|alert\'.split(\'|\'),0,{}))';
    
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
