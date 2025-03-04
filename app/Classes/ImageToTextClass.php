<?php 

namespace App\Classes;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin\General;
use thiagoalessio\TesseractOCR\TesseractOCR;

class ImageToTextClass {

	public function get_data( $imagePath )
	{
		$data['text']  = (new TesseractOCR($imagePath))->run();
		
		return $data;
	}
}