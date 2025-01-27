<?php 

namespace App\Classes;
use \Done\Subtitles\Subtitles;

class SrtToVttClass {

	public function get_data($temp_path)
	{

		try {

			$fileName = time() . '.vtt';

			Subtitles::convert($temp_path, storage_path('app/livewire-tmp/' . $fileName));

	        $data['url'] = asset('components/storage/app/livewire-tmp/' . $fileName);

	        $data['fileName'] = $fileName;

	        return $data;

		} catch(\Exception $e) {

		    echo "Error: ". $e->getMessage();
		}

	}
}