<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use Livewire\WithFileUploads;
use DateTime;
use App\Models\Admin\General;
use Image;
use Illuminate\Support\Facades\Storage;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;

class WebpToJpg extends Component
{

    use WithFileUploads;

    protected $listeners = ['onSetRemoteURL'];
    public $convertType = 'localImage';
    public $remote_url;
    public $local_image;
    public $data = [];
    public $recaptcha;

    public function render()
    {
        return view('livewire.public.tools.webp-to-jpg');
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
            : ['local_image' => 'required|mimes:webp|file|max:' . (1024 * General::first()->file_size)];

        if (General::first()->captcha_status) {
            $baseValidationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        return $baseValidationRules;
    }

    /**
     * -------------------------------------------------------------------------------
     *  onWebpToJpg
     * -------------------------------------------------------------------------------
    **/
    public function onWebpToJpg(){

        $validationRules = $this->getValidationRules();

        $this->validate($validationRules);

        $this->data = null;

        try {

                if ( $this->convertType == 'remoteURL') {

                    $fileName = pathinfo($this->remote_url, PATHINFO_BASENAME);            

                    $fileNameTemp = time() . '.' . pathinfo( $this->remote_url, PATHINFO_EXTENSION);

                    Storage::disk('local')->put('livewire-tmp/' . $fileNameTemp, Http::get($this->remote_url) );
           
                    $temp_url = asset('components/storage/app/livewire-tmp/' . $fileNameTemp);
                }
                else {
                    
                    $fileNameTemp = $this->local_image->store('livewire-tmp');

                    $temp_url = asset('components/storage/app') . '/' . $fileNameTemp;
                }
                
                if ( pathinfo( $temp_url, PATHINFO_EXTENSION) == 'webp' ) {

                    $img = Image::make( $temp_url )->encode('jpg');

                    $fileName = time() . '.jpg';

                    $img->save( storage_path('app/livewire-tmp/') . $fileName );

                    $url  = asset('components/storage/app/livewire-tmp/' . $fileName);

                    $data['url']      = $url;
                    $data['filename'] = General::orderBy('id', 'DESC')->first()->prefix . time();
                    $data['type']     = 'jpg';
                    $dlLink           = url('/') . '/dl.php?token=' . $this->encode( json_encode($data) );

                    $this->dispatchBrowserEvent('showModal', ['id' => 'modalPreviewDownloadImage', 'preview' => $url, 'download' => $dlLink ]);

                } else $this->addError('error', __('The image must be a file of type: webp.'));

                $this->dispatchBrowserEvent('resetReCaptcha');

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        
        
    }

    /**
     * -------------------------------------------------------------------------------
     *  encode
     * -------------------------------------------------------------------------------
    **/
    function encode($pData)
    {
        $encryption_key = 'themeluxurydotcom';

        $encryption_iv = '9999999999999999';

        $ciphering = "AES-256-CTR"; 
          
        $encryption = openssl_encrypt($pData, $ciphering, $encryption_key, 0, $encryption_iv);

        return $encryption;
    }

}
