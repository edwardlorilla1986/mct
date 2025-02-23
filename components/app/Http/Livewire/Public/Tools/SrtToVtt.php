<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Classes\IcoToPngClass;
use Livewire\WithFileUploads;
use DateTime, File;
use App\Classes\SrtToVttClass;
use App\Models\Admin\General;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;

class SrtToVtt extends Component
{

    use WithFileUploads;

    protected $listeners = ['onSetRemoteURL'];
    public $convertType = 'localFile';
    public $remote_url;
    public $local_file;
    public $data = [];
    public $recaptcha;

    public function render()
    {
        return view('livewire.public.tools.srt-to-vtt');
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
            : ['local_file' => 'required|file|max:' . (1024 * General::first()->file_size)];

        if (General::first()->captcha_status) {
            $baseValidationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        return $baseValidationRules;
    }

    /**
     * -------------------------------------------------------------------------------
     *  onSrtToVtt
     * -------------------------------------------------------------------------------
    **/
    public function onSrtToVtt(){

        $validationRules = $this->getValidationRules();

        $this->validate($validationRules);

        $this->data = null;

        try {

            $output = new SrtToVttClass();

            if ( $this->convertType == 'remoteURL') {

                $fileName = pathinfo($this->remote_url, PATHINFO_BASENAME);            

                $fileNameTemp = time() . '.' . pathinfo( $this->remote_url, PATHINFO_EXTENSION);

                Storage::disk('local')->put('livewire-tmp/' . $fileNameTemp, Http::get($this->remote_url) );
       
                $temp_path = storage_path('app/livewire-tmp/') . $fileNameTemp;

                $temp_url = asset('components/storage/app/livewire-tmp/' . $fileNameTemp);
            }
            else {
                
                $fileNameTemp = $this->local_file->store('livewire-tmp');

                $renamed = str_replace('.txt', '.srt', storage_path('app') . '/' . $fileNameTemp );

                rename( storage_path('app') . '/' . $fileNameTemp, $renamed);

                $temp_path = $renamed;

                $temp_url = str_replace('.txt', '.srt', asset('components/storage/app') . '/' . $fileNameTemp );
            }
            
            //
            if ( pathinfo( $temp_url, PATHINFO_EXTENSION) == 'srt') {

                $this->data = $output->get_data( $temp_path );

                $this->dispatchBrowserEvent('showModal', ['id' => 'modalPreviewDownloadFile', 'url' => $this->data['url'], 'fileName' => General::first()->prefix . $this->data['fileName'] ]);

            } else $this->addError('error', __('The image must be a file of type: srt.'));

            $this->dispatchBrowserEvent('resetReCaptcha');

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        if ( !empty($this->data) ) {

        }
        
    }
}
