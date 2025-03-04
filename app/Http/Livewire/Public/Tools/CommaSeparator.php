<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use App\Classes\CommaSeparatorClass;
use DateTime;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class CommaSeparator extends Component
{

    public $text;
    public $delimiter = ',';
    public $data = [];
    public $recaptcha;

    public function render()
    {
        return view('livewire.public.tools.comma-separator');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onCommaSeparator
     * -------------------------------------------------------------------------------
    **/
    public function onCommaSeparator(){

        $validationRules = [
            'text' => 'required',
        ];

        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        try {

            $output = new CommaSeparatorClass();

            $this->data = $output->get_data( $this->text, $this->delimiter);

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
Dewberry
Watermelon
Blueberry
Mango
Nutmeg
Pineapple
Eggplant
Cherry
Zucchini
Horseradish
Orange
Lettuce
Kale
Strawberry
Radish
Grape
Apple
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
        $this->data = null;
    }
}
