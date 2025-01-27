<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use DateTime, File;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class CpmCalculator extends Component
{

    public $cost;
    public $cpm;
    public $impressions;
    public $recaptcha;
    public $data = [];

    public function render()
    {
        return view('livewire.public.tools.cpm-calculator');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onCpmCalculator
     * -------------------------------------------------------------------------------
    **/
    public function onCpmCalculator(){

        $validationRules = [];
        
        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        if (!empty($validationRules)) {
            $this->validate($validationRules);
        }

        $this->data = null;

        try {

                if ($this->cost != null && $this->cpm != null && $this->impressions == null) {

                    $this->data['cpm']            =  number_format($this->cpm);

                    $this->data['ad_impressions'] =  number_format($this->cost / $this->cpm * 1e3);

                    $this->data['amount']         =  number_format($this->cost);

                } else if( $this->cost != null && $this->impressions != null && $this->cpm == null) {

                    $this->data['cpm']            =  number_format( ((100 * ($this->cost / $this->impressions * 1e3 )) / 100 ) );

                    $this->data['ad_impressions'] =  number_format($this->impressions);

                    $this->data['amount']         =  number_format($this->cost);

                } else if($this->impressions != null && $this->cpm != null && $this->cost == null) {

                    $this->data['cpm']            =  number_format($this->cpm);

                    $this->data['ad_impressions'] =  number_format($this->impressions);

                    $this->data['amount']         =  number_format($this->cpm * ( $this->impressions / 1e3));

                }
                else $this->addError('error', __('You need to enter two of the fields using this calculator, and it will resolve the last one.'));

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
        $this->cost = 100;
        $this->cpm  = 10;
    }

    /**
     * -------------------------------------------------------------------------------
     *  onReset
     * -------------------------------------------------------------------------------
    **/
    public function onReset()
    {
        $this->cost        = null;
        $this->cpm         = null;
        $this->impressions = null;
        $this->data        = null;
    }
}
