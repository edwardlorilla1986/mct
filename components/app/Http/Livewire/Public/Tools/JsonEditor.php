<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use DateTime, File;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Models\Admin\General;
use App\Rules\VerifyRecaptcha;

class JsonEditor extends Component
{

    public $json;
    public $data;
    public $recaptcha;

    protected $listeners = ['onSetJsonData'];

    public function render()
    {
        return view('livewire.public.tools.json-editor');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onSetJsonData
     * -------------------------------------------------------------------------------
    **/
    public function onSetJsonData($value)
    {
        $this->json = $value;
        $this->data = null;
    }

    /**
     * -------------------------------------------------------------------------------
     *  onJsonEditor
     * -------------------------------------------------------------------------------
    **/
    public function onJsonEditor(){

        $validationRules = [
            'json' => 'required'
        ];

        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        try {

            $this->dispatchBrowserEvent('onDownload', ['fileName' => General::first()->prefix . time() ]);

            $this->dispatchBrowserEvent('resetReCaptcha');
            
        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        

    }

    /**
     * -------------------------------------------------------------------------------
     *  onSample
     * -------------------------------------------------------------------------------
    **/
    public function onSample()
    {
        $this->dispatchBrowserEvent('onSample', ['json' => '{
  "firstName": "John",
  "lastName": "Smith",
  "gender": "man",
  "age": 30,
  "address": {
    "streetAddress": "150",
    "city": "San Diego",
    "state": "CA",
    "postalCode": "263142"
  }
}']);
        
        $this->data = null;
    }

    /**
     * -------------------------------------------------------------------------------
     *  onReset
     * -------------------------------------------------------------------------------
    **/
    public function onReset()
    {
        $this->dispatchBrowserEvent('onReset', ['json' => '{}']);
        $this->data = null;
    }
}
