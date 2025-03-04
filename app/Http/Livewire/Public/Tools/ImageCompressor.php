<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use Livewire\WithFileUploads;
use DateTime, File;
use Illuminate\Support\Facades\Storage;
use ImageOptimizer;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Models\Admin\General;
use App\Classes\SWTClass;
use Illuminate\Http\Request;

class ImageCompressor extends Component
{
    use WithFileUploads;
    protected $listeners = ['onSetRemoteURL'];
    public $convertType = 'localFile';
    public $remote_url;
    public $local_file;
    public $data = [];
    public $recaptcha;
    const STORAGE_PATH = 'app/livewire-tmp/';
    public $generalSettings;

    public function mount()
    {
        $this->generalSettings = General::first();
    }
	
    public function render()
    {
        return view('livewire.public.tools.image-compressor');
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
    public function onConvertType($type){
        $this->convertType = $type;
    }

    /**
     * -------------------------------------------------------------------------------
     *  onImageCompressor
     * -------------------------------------------------------------------------------
     **/
    public function onImageCompressor(Request $request)
    {
        try {
            $files = $request->file('file');
            foreach ($files as $file) {
                return $this->processFile($file);
            }
        } catch (\Exception $e) {
            $this->addError('error', __($e));
        }
    }

    /**
     * -------------------------------------------------------------------------------
     *  validateInputs
     * -------------------------------------------------------------------------------
     **/
    private function validateInputs()
    {
        $validationRules = $this->convertType == 'remoteURL'
            ? ['remote_url' => 'required|url']
            : ['local_file' => 'required|mimetypes:image/*|file|max:'. 1024 * General::first()->file_size];

        // Add captcha validation if captcha status is enabled
        if ( $this->generalSettings->captcha_status && ($this->generalSettings->captcha_for_registered || !auth()->check()) ) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);
    }

    /**
     * -------------------------------------------------------------------------------
     *  handleRemoteFile
     * -------------------------------------------------------------------------------
     **/
    private function handleRemoteFile()
    {
        $fileName = pathinfo($this->remote_url, PATHINFO_BASENAME);
        $fileNameTemp = time() . '.' . pathinfo($this->remote_url, PATHINFO_EXTENSION);
        Storage::disk('local')->put('livewire-tmp/' . $fileNameTemp, Http::get($this->remote_url));
        return storage_path('app/livewire-tmp/') . $fileNameTemp;
    }

    /**
     * -------------------------------------------------------------------------------
     *  handleLocalFile
     * -------------------------------------------------------------------------------
     **/
    private function handleLocalFile()
    {
        $previewPath = $this->local_file->store('livewire-tmp');
        return storage_path('app/') . $previewPath;
    }

    /**
     * -------------------------------------------------------------------------------
     *  isValidFile
     * -------------------------------------------------------------------------------
     **/
    private function isValidFile($filePath)
    {
        $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
        return in_array($fileExtension, ['jpg', 'jpeg', 'png']);
    }

    /**
     * -------------------------------------------------------------------------------
     *  processFile
     * -------------------------------------------------------------------------------
     **/
    private function processFile($file)
    {
        $fileName = $file->getClientOriginalName();
        $fileType = $file->getClientOriginalExtension();

        $file->move(storage_path(self::STORAGE_PATH), $fileName);

        $oldFileSize = File::size(storage_path(self::STORAGE_PATH . $fileName));
        $newFileName = General::first()->prefix . time() . '.' . $fileType;

        ImageOptimizer::optimize(storage_path(self::STORAGE_PATH . $fileName), storage_path(self::STORAGE_PATH . $newFileName));

        $newFileSize = File::size(storage_path(self::STORAGE_PATH . $newFileName));
        $saved = round(100 - ($newFileSize / $oldFileSize * 100));

        return $this->generateResponseData($oldFileSize, $newFileSize, $saved, $newFileName, $fileType);
    }

    /**
     * -------------------------------------------------------------------------------
     *  generateResponseData
     * -------------------------------------------------------------------------------
     **/
    private function generateResponseData($oldFileSize, $newFileSize, $saved, $newFileName, $fileType)
    {
        $swt = new SWTClass();

        $dataFiles['url'] = asset('components/storage/app/livewire-tmp/' . $newFileName);
        $dataFiles['filename'] = General::orderBy('id', 'DESC')->first()->prefix . time();
        $dataFiles['type'] = $fileType;
        $dlLink = url('/') . '/dl.php?token=' . $swt->encode(json_encode($dataFiles));

        $data['success']  = true;
        $data['status']   = 'Finished';
        $data['old_size'] = $swt->formatSizeUnits($oldFileSize);
        $data['new_size'] = $swt->formatSizeUnits($newFileSize);
        $data['saved']    = $saved . '%';
        $data['link']     = $dlLink;

        $this->saveHistory();
        
        return $data;
    }

    /**
     * -------------------------------------------------------------------------------
     *  saveHistory
     * -------------------------------------------------------------------------------
     **/
    private function saveHistory()
    {

        $history             = new History;
        $history->tool_name  = 'Image Compressor';
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
