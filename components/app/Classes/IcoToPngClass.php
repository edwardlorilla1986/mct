<?php 

namespace App\Classes;
use Illuminate\Support\Facades\Http;
use Elphin\IcoFileLoader\IcoFileService;

class IcoToPngClass {

	public function get_data( $temp_url )
	{
		$loader = new IcoFileService;

		$icon = $loader->fromFile( $temp_url );

		$i = 0;

		foreach ($icon as $idx => $image) {
			
			$im                    = $loader->renderImage($image);
			
			$filename              = sprintf('%d-img%d-%dx%d.png', time(), $idx, $image->width, $image->height);
			
			imagepng($im, storage_path('app/livewire-tmp/') . $filename );
			
			$get_source            = Http::get( asset('components/storage/app/livewire-tmp/' . $filename) );

			$data[$i]['thumbnail'] = 'data:image/png;base64,' . base64_encode($get_source);
			$data[$i]['width']     = $image->width;
			$data[$i]['height']    = $image->height;

			$i++;
		}

		return $data;

	}
}