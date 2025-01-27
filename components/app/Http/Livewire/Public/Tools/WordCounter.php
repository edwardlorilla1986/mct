<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use App\Classes\WordCounterClass;
use DateTime, File;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class WordCounter extends Component
{

    public $text;
    public $words, $characters, $characters_with_spaces , $paragraphs;
    public $data = [];
    public $recaptcha;

    public function render()
    {
        return view('livewire.public.tools.word-counter');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onWordCounter
     * -------------------------------------------------------------------------------
    **/
    public function onWordCounter(){

        $validationRules = [
            'text' => 'required'
        ];

        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        try {

                $output = new WordCounterClass();

                $this->data = $output->get_data( $this->text );

                $this->dispatchBrowserEvent('resetReCaptcha');

        } catch (\Exception $e) {
            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        if ( !empty($this->data) ) {

        }
        //

    }

    /**
     * -------------------------------------------------------------------------------
     *  onSample
     * -------------------------------------------------------------------------------
    **/
    public function onSample()
    {
        $this->text = 'Hello World!';
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
