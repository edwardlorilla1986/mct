<?php 

namespace App\Classes;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use NcJoes\OfficeConverter\OfficeConverter;

class WebpToPdfClass {


    /**
     * -------------------------------------------------------------------------------
     *  get_data
     * -------------------------------------------------------------------------------
    **/
	public function get_data($filePath)
	{
	    try {
	        $convertedFilePath = $this->convertWebpToPdf($filePath);

	        if (!empty($convertedFilePath)) {

	            $data['fileName'] = $convertedFilePath;

	            return $data;
	        }

	        return null;

	    } catch (\Exception $e) {
	        Log::error('An error occurred while converting the file to PDF: ' . $e->getMessage());
	        return null;
	    }
	}

    /**
     * -------------------------------------------------------------------------------
     *  convertWebpToPdf
     * -------------------------------------------------------------------------------
    **/
	private function convertWebpToPdf($filePath)
	{
	    $jpegImage = storage_path('app/livewire-tmp/') . time() . '.jpg'; // Path to save the converted JPEG image

	    // Convert WebP to JPG using PHP GD
	    $img = imagecreatefromwebp($filePath);
	    imagejpeg($img, $jpegImage, 100);
	    imagedestroy($img);
	$javaHome = '/home/eyygsv3j0a44/java';
        $libreOfficePath = '/home/eyygsv3j0a44/libreoffice/squashfs-root/AppRun';
        $command = sprintf(
            'export JAVA_HOME=%s && export PATH=$JAVA_HOME/bin:$PATH && %s --headless --nologo --nolockcheck -env:UserInstallation=file:///tmp/LibreOfficeUser --convert-to pdf %s --outdir %s',
            escapeshellcmd($javaHome),
            escapeshellcmd($libreOfficePath),
            escapeshellarg($jpegImage),
            escapeshellcmd(storage_path('app/livewire-tmp'))
        );
        $output = shell_exec($command . ' 2>&1');
        $outputDir = dirname($filePath); 
        $filePathWithoutExtension = substr($filePath, 0, strrpos($filePath, '.'));

        $outputFile = $filePathWithoutExtension . '.pdf';
        
        

        
        return ['fileName' => $outputFile];
	   
	}
}