<?php 

namespace App\Classes;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Dompdf\Dompdf;

class HtmlToPdfClass {

	public function get_data( $fileLink )
	{
		$dompdf = new Dompdf();

		$html = file_get_contents( $fileLink ); 

		$dompdf->loadHtml($html); 

		$dompdf->render();

	    $output = $dompdf->output();

	    $fileName = time() . '.pdf';

	    file_put_contents( storage_path('app/livewire-tmp/'). $fileName, $output);

		if ( file_exists( storage_path('app/livewire-tmp/'). $fileName ) ) {

			$data['fileName'] = $fileName;

			return $data;
		}

		return null;
	}

}