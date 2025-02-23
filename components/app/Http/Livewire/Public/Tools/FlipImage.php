<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use DateTime, File;
use App\Models\Admin\General;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;

class FlipImage extends Component
{
    protected $listeners = ['onFlipImage'];
    public $convertType = 'localImage';
    public $remote_url;
    public $recaptcha;

    public function render()
    {
        return view('livewire.public.tools.flip-image');
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
     *  onAddRemoteURL
     * -------------------------------------------------------------------------------
    **/
    public function onAddRemoteURL()
    {
        $this->validate([
            'remote_url' => 'required|url'
        ]);

        try {

            $fileName = pathinfo($this->remote_url, PATHINFO_BASENAME);            

            $fileNameTemp = time() . '.' . pathinfo( $this->remote_url, PATHINFO_EXTENSION);

            Storage::disk('local')->put('livewire-tmp/' . $fileNameTemp, Http::get($this->remote_url) );
   
            $temp_url = asset('components/storage/app/livewire-tmp/' . $fileNameTemp);

            $fileType = File::mimeType( storage_path('app/livewire-tmp/') . $fileNameTemp );

            $this->dispatchBrowserEvent('onSetRemoteURL', ['url' => $temp_url, 'fileName' => $fileName, 'fileType' => $fileType ]);

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }
    }

    /**
     * -------------------------------------------------------------------------------
     *  onFlipImage
     * -------------------------------------------------------------------------------
    **/
    public function onFlipImage( $blobURL, $fileName ){

        $validationRules = [];
        
        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        if (!empty($validationRules)) {
            $this->validate($validationRules);
        }

        try {

            $this->dispatchBrowserEvent('showModal', ['id' => 'modalPreviewDownloadImage', 'blobURL' => $blobURL, 'fileName' => General::first()->prefix . $fileName ]);

            $this->dispatchBrowserEvent('resetReCaptcha');

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        
    }
}
