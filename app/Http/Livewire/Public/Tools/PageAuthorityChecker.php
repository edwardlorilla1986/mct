<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use App\Classes\PageAuthorityCheckerClass;
use DateTime;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;
use App\Rules\DomainNameValidation;

class PageAuthorityChecker extends Component
{

    public $link;
    public $data = [];
    public $recaptcha;

    public function render()
    {
        return view('livewire.public.tools.page-authority-checker');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onPageAuthorityChecker
     * -------------------------------------------------------------------------------
    **/
    public function onPageAuthorityChecker(){

        $validationRules = [
            'link' => [
                'required',
                'max:255',
                new DomainNameValidation()
            ]
        ];

        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        try {

            $output = new PageAuthorityCheckerClass();

            $this->data = $output->get_data( $this->link );

            $this->dispatchBrowserEvent('resetReCaptcha');
                
        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'Page Authority Checker';
            $history->client_ip  = request()->ip();

            require app_path('Classes/geoip2.phar');

            $reader = new Reader( app_path('Classes/GeoLite2-City.mmdb') );

            try {

                $record           = $reader->city( request()->ip() );

                $history->flag    = strtolower( $record->country->isoCode );
                
                $history->country = strip_tags( $record->country->name );

            } catch (AddressNotFoundException $e) {

            }

            $history->created_at = new DateTime();
            $history->save();
        }
    }
    //
}
