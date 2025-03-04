<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use App\Classes\IcoConverterClass;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use DateTime;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Models\Admin\General;
use App\Rules\VerifyRecaptcha;

class IcoConverter extends Component
{

    use WithFileUploads;

    protected $listeners = ['onSetRemoteURL'];
    public $convertType = 'localImage';
    public $remote_url;
    public $local_image;
    public $data = [];
    public $icon_size = 32;
    public $recaptcha;

    public function render()
    {
        return view('livewire.public.tools.ico-converter');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onSetRemoteURL
     * -------------------------------------------------------------------------------
    **/
    public function onSetRemoteURL($value)
    {
      $this->remote_url = $value;
    }

    /**
     * -------------------------------------------------------------------------------
     *  onConvertType
     * -------------------------------------------------------------------------------
    **/
    public function onConvertType( $type ){
        $this->convertType = $type;
    }

    /**
     * -------------------------------------------------------------------------------
     *  getValidationRules
     * -------------------------------------------------------------------------------
    **/
    public function getValidationRules()
    {
        $baseValidationRules = $this->convertType === 'remoteURL'
            ? ['remote_url' => 'required|url']
            : ['local_image' => 'required|image|file|max:' . (1024 * General::first()->file_size)];

        if (General::first()->captcha_status) {
            $baseValidationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        return $baseValidationRules;
    }

    /**
     * -------------------------------------------------------------------------------
     *  onIcoConverter
     * -------------------------------------------------------------------------------
    **/
    public function onIcoConverter(){

        $validationRules = $this->getValidationRules();

        $this->validate($validationRules);

        $this->data = null;

        try {

            $output = new IcoConverterClass();

            if ( $this->convertType == 'remoteURL') {
			
				$fileName = pathinfo($this->remote_url, PATHINFO_BASENAME);            

				$fileNameTemp = time() . '.' . pathinfo( $this->remote_url, PATHINFO_EXTENSION);

				Storage::disk('local')->put('livewire-tmp/' . $fileNameTemp, Http::get($this->remote_url) );

				$temp_url = asset('components/storage/app/livewire-tmp/' . $fileNameTemp);
            }
            else {
                $temp_path = $this->local_image->store('livewire-tmp');
                $temp_url = asset('components/storage/app/' . $temp_path);
            }
            
            $this->data = $output->get_data( $temp_url, $this->icon_size );

            $this->dispatchBrowserEvent('resetReCaptcha');

        } catch (\Exception $e) {

           $this->addError('error', __($e->getMessage()));
        }

        //Save History
        if ( !empty($this->data) ) {

           
        }
        
    }

}
