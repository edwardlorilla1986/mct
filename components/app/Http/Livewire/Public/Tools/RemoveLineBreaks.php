<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use App\Classes\RemoveLineBreaksClass;
use DateTime, File;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class RemoveLineBreaks extends Component
{
    public $text;
    public $para_option = 'no_paragraphs';
    public $data = [];
    public $recaptcha;

    public function render()
    {
        return view('livewire.public.tools.remove-line-breaks');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onRemoveLineBreaks
     * -------------------------------------------------------------------------------
    **/
    public function onRemoveLineBreaks(){

        $validationRules = [
            'text'        => 'required',
            'para_option' => 'required'
        ];

        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        try {

            $output = new RemoveLineBreaksClass();

            $this->data = $output->get_data( $this->text, $this->para_option );

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
    $this->text = <<<EOT
Tomato
Nutmeg

Zucchini


Mango
EOT;
    }

    /**
     * -------------------------------------------------------------------------------
     *  onReset
     * -------------------------------------------------------------------------------
    **/
    public function onReset()
    {
        $this->text = null;
        $this->data = [];
    }
}
