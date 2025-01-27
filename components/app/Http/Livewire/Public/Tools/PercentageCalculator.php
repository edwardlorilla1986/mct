<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use DateTime, File;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class PercentageCalculator extends Component
{

    public $percentage;
    public $percentageOf;
    public $percentageResult;

    public $percentageIs;
    public $percentageWhat;
    public $percentageWhatResult;

    public $isPercentage;
    public $isPercentageOf;
    public $isPercentageOfResult;

    public $recaptcha;

    public function render()
    {
        return view('livewire.public.tools.percentage-calculator');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onPercentageCalculator
     * -------------------------------------------------------------------------------
    **/
    public function onPercentageCalculator(){

        $validationRules = [
            'percentage'   => 'required|numeric',
            'percentageOf' => 'required|numeric'
        ];

        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        try {

            $this->percentageResult = $this->percentage * $this->percentageOf / 100;

            $this->dispatchBrowserEvent('resetReCaptcha');

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        

    }

    /**
     * -------------------------------------------------------------------------------
     *  onPercentageWhatCalculator
     * -------------------------------------------------------------------------------
    **/
    public function onPercentageWhatCalculator(){

        $this->validate([
            'percentageIs'   => 'required|numeric',
            'percentageWhat' => 'required|numeric'
        ]);

        try {

            $this->percentageWhatResult = round( $this->percentageIs / $this->percentageWhat * 100, 2) . '%';
            

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

       

    }

    /**
     * -------------------------------------------------------------------------------
     *  onIsPercentageOfCalculator
     * -------------------------------------------------------------------------------
    **/
    public function onIsPercentageOfCalculator(){

        $this->validate([
            'isPercentage'   => 'required|numeric',
            'isPercentageOf' => 'required|numeric'
        ]);

        try {

            $this->isPercentageOfResult = round( $this->isPercentage / $this->isPercentageOf * 100, 2);
            

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

       

    }

}
