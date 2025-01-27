<?php 

namespace App\Classes;
use Illuminate\Support\Facades\Http;
require_once __DIR__ . "/Modules/class-php-ico.php";
use App\Classes\Modules\PHP_ICO;

class JpgToIcoClass {

	public function get_data( $link, $icon_size )
	{
		switch ($icon_size) {
			case 'all':
			          $sizes = array(
			            array( 16, 16 ),
			            array( 24, 24 ),
			            array( 32, 32 ),
			            array( 48, 48 ),
			            array( 64, 64 ),
			            array( 96, 96 ),
			            array( 128, 128 ),
			            array( 192, 192 ),
			            array( 256, 256 )
			          );
				break;
			
			default:
			          $sizes = array(
			            array( $icon_size, $icon_size )
			          );
				break;
		}

		$convert = new PHP_ICO( $link, $sizes);

		$time = time();

		$ico_path = storage_path('app/livewire-tmp/') . $time . '.ico';

        $convert->save_ico($ico_path);

        $get_source = Http::get( asset('components/storage/app/livewire-tmp/' . $time . '.ico') );
        	
        $data['thumbnail'] = 'data:image/x-icon;base64,' . base64_encode($get_source);

        return $data;

	}
}