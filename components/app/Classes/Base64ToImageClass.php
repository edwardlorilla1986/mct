<?php 

namespace App\Classes;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin\General;

class Base64ToImageClass {

	public function get_data( $base64_string )
	{

		$swt = new SWTClass();
		
		$imageType = explode('/', mime_content_type($base64_string))[1];

		if( $imageType == 'jpeg' ) $imageType = 'jpg';
		
		$fileName = General::first()->prefix . time() . '.' . $imageType;

		if (preg_match('/^data:image\/(\w+);base64,/', $base64_string)) {

		    $base64_data = substr($base64_string, strpos($base64_string, ',') + 1);

		    $base64_data = base64_decode($base64_data);

	        Storage::disk('local')->put('livewire-tmp/' . $fileName, $base64_data);

	        $url = asset('components/storage/app/livewire-tmp/' . $fileName);

			$dataFiles['url']      = $url;
			$dataFiles['filename'] = General::first()->prefix . time();
			$dataFiles['type']     = $imageType;
			$dlLink                = url('/') . '/dl.php?token=' . $swt->encode( json_encode($dataFiles) );

			$data['preview']  = $url;
			$data['download'] = $dlLink;

	        return $data;
		}

	}
}