<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use App\Classes\PngToPdfClass;
use Livewire\WithFileUploads;
use DateTime;
use Illuminate\Support\Facades\Storage;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Models\Admin\General;
use NcJoes\OfficeConverter\OfficeConverter;
use App\Rules\VerifyRecaptcha;

class PngToPdf extends Component
{

    use WithFileUploads;

    protected $listeners = ['onSetRemoteURL'];
    public $convertType = 'localFile';
    public $remote_url;
    public $local_file;
    public $data = [];
    public $recaptcha;
    public $generalSettings;

    public function mount()
    {
        $this->generalSettings = General::first();
    }
	
    public function render()
    {
        return view('livewire.public.tools.png-to-pdf');
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
     *  onPngToPdf
     * -------------------------------------------------------------------------------
     **/
    public function onPngToPdf()
    {
          \Log::info('Attempting to access file:1 ' );
        $this->validateInputs();

        $this->data = null;

        try {
            if ($this->convertType == 'remoteURL') {
                $filePath = $this->handleRemoteFile();
            } else {
                 \Log::info('Attempting to access file:2 ' );
                $filePath = $this->handleLocalFile();
            }
 \Log::info('Attempting to access file:3 ' );
            if ($this->isValidFile($filePath)) {
                 \Log::info('Attempting to access file:4 ' );
                $this->processFile($filePath);
                 \Log::info('Attempting to access file:5 ' );
                $this->dispatchBrowserEvent('resetReCaptcha');
            } else {
                $this->addError('error',  'The image must be a file of type: png.');
            }

        } catch (\Exception $e) {
            $this->addError('error', $e->getMessage());
        }

        //$this->saveHistory();
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
            : ['local_file' => 'required|mimes:png|file|max:' . 1024 * General::first()->file_size];

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
        return storage_path('livewire-tmp/') . $fileNameTemp;
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
        return in_array($fileExtension, ['png']);
    }

    /**
     * -------------------------------------------------------------------------------
     *  processFile
     * -------------------------------------------------------------------------------
     **/
    public function processFile($filePath)
{
    $output = new PngToPdfClass();

    // Log file path before processing
    \Log::info('Processing file at: ' . $filePath);

    try {
        // Ensure the file exists before proceeding
        if (!file_exists($filePath)) {
            throw new \Exception('File not found: ' . $filePath);
        }

        $this->data = $output->get_data($filePath);

            $filePathWithoutExtension = substr( $this->data['fileName'], 0, strrpos($filePath, '.'));

        $outputFile = $filePathWithoutExtension . '.pdf';
        
          if (!file_exists($outputFile)) {
            \Log::error('File not found: ' . $outputFile);
            throw new \Exception('File not found: ' . $outputFile);
        }

        // Extract the file name
        $fileName = basename($outputFile);

            
            $url = asset('components/storage/app/livewire-tmp/' . $fileName);
            $data['url'] = $url;
 \Log::error('3');
            $general = General::orderBy('id', 'DESC')->first();
             \Log::error('4');
            $prefix = $general ? $general->prefix : 'default_prefix';
 \Log::error('5');
            $data['filename'] = $prefix . time();
            $data['type'] = 'pdf';
 \Log::error('6');
            $dlLink = url('/') . '/dl.php?token=' . $this->encode(json_encode($data));

            \Log::info('File processed successfully. URL: ' . $url);

            // Dispatch event to show the modal
            $this->dispatchBrowserEvent('showModal', [
                'id' => 'modalPreviewDownloadFile',
                'download' => $dlLink,
                'preview' => $url,
            ]);
        
    } catch (\Exception $e) {
        \Log::error('Error processing file: ' . $e);
        $this->addError('error', $e->getMessage());
    }
}

    /**
     * -------------------------------------------------------------------------------
     *  saveHistory
     * -------------------------------------------------------------------------------
     **/
    private function saveHistory()
    {
      
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
