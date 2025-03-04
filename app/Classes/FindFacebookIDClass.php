<?php 

namespace App\Classes;
use Illuminate\Support\Facades\Http;
use App\Models\Admin\ApiKeys;
use App\Classes\SWTClass;

class FindFacebookIDClass {

	public function get_data($link)
	{
        $swt = new SWTClass();

        $api_key = ApiKeys::findOrFail(1);

        if ( !empty($api_key->facebook_cookies) ) {

            $get_source = $swt->fb_get_contents($link, $api_key->facebook_cookies);

            preg_match('/"entity_id":"(.*?)"/', $get_source, $matchID);

            preg_match('/"userID":"(.*?)"/', $get_source, $matchUserID);

            if ( !empty($matchID[1]) ) {

                $data['thumbnail'] = 'https://graph.facebook.com/'.$matchID[1].'/picture?type=large&width=500&height=500&access_token=6628568379%7Cc1e620fa708a1d5696fb991c1bde5662';

                $data['id'] = $matchID[1];
                
                return $data;
     
            }
            else if ( !empty($matchUserID[1]) ) {

                $data['thumbnail'] = 'https://graph.facebook.com/'.$matchUserID[1].'/picture?type=large&width=500&height=500&access_token=6628568379%7Cc1e620fa708a1d5696fb991c1bde5662';

                $data['id'] = $matchUserID[1];
                
                return $data;
     
            }
            else {

                $data['thumbnail'] = url('assets/img/no-thumb.jpg');

                $data['id'] = 'N/a';

                return $data;
     
            }

        } else{

                $get_source = $swt->url_get_contents($link);

                preg_match('/fb:\/\/profile\/(\d+)|fb:\/\/page\/\?id=(\d+)|fb:\/\/group\/\?id=(\d+)/', $get_source, $matchUserID);
                
                if ( !empty($matchUserID[1]) ) {

                    $data['thumbnail'] = 'https://graph.facebook.com/'.$matchUserID[1].'/picture?type=large&width=500&height=500&access_token=6628568379%7Cc1e620fa708a1d5696fb991c1bde5662';

                    $data['id'] = $matchUserID[1];
                    
                    return $data;
         
                }
                else {

                    $data['thumbnail'] = url('assets/img/no-thumb.jpg');

                    $data['id'] = 'N/a';

                    return $data;
         
                }
        }

	}


}