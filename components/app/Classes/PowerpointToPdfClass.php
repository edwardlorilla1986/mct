<?php 

namespace App\Classes;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use NcJoes\OfficeConverter\OfficeConverter;

class PowerpointToPdfClass {

	public function get_data( $filePath )
	{
	$javaHome = '/home/eyygsv3j0a44/java';
        $libreOfficePath = '/home/eyygsv3j0a44/libreoffice/squashfs-root/AppRun';
        $command = sprintf(
            'export JAVA_HOME=%s && export PATH=$JAVA_HOME/bin:$PATH && %s --headless --nologo --nolockcheck -env:UserInstallation=file:///tmp/LibreOfficeUser --convert-to pdf %s --outdir %s',
            escapeshellcmd($javaHome),
            escapeshellcmd($libreOfficePath),
            escapeshellarg($filePath),
            escapeshellcmd(storage_path('app/livewire-tmp'))
        );
        $output = shell_exec($command . ' 2>&1');
        $outputDir = dirname($filePath); 
        $filePathWithoutExtension = substr($filePath, 0, strrpos($filePath, '.'));

        $outputFile = $filePathWithoutExtension . '.pdf';
        
        

        
        return ['fileName' => $outputFile];
	}
}