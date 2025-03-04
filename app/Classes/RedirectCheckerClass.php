<?php 

namespace App\Classes;
use App\Classes\SSTClass;

class RedirectCheckerClass {

    public function get_data($link)
    {
        try {

            $sst = new SSTClass();
            
            $result = $sst->url_get_response_details($link);

            if ( !empty($result['http_code']) ) {

                $data['link'] = $link;

                $data['http_code'] = $result['http_code'];

                $data['final_url'] = $result['final_url'];

                return $data;
                
            } else{
                session()->flash('status', 'error');
                session()->flash('message', __( 'Whoops! Something went wrong.'));
                return;
            }
            
        } catch (\Exception $e) {

            session()->flash('status', 'error');
            session()->flash('message', __($e->getMessage()));
            return;
        }

    }


    //

}