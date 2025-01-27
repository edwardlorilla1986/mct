<?php 

namespace App\Classes;
use Illuminate\Support\Facades\Http;

class ImageToBase64Class {

	public function get_data( $link )
	{
        
        $get_source = Http::get($link);

        $data['text'] = 'data:image/' . pathinfo( $link, PATHINFO_EXTENSION) . ';base64,' . base64_encode($get_source);

        return $data;

	}
}