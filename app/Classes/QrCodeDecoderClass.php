<?php 

namespace App\Classes;
use Zxing\QrReader;

class QrCodeDecoderClass {

	public function get_data( $temp_url )
	{
		$qrcode = new QrReader( $temp_url );

		$data['text'] = $qrcode->text();

		return $data;

	}
}