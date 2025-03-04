<?php 

namespace App\Classes;
use App\Classes\SWTClass;

class UtmBuilderClass {
    
	public function get_data($link, $utm_source, $utm_medium, $utm_campaign, $utm_content, $utm_term)
	{

        try {

            // Create an array of UTM parameters
            $utm_params = [
                'utm_source'   => $utm_source,
                'utm_medium'   => $utm_medium,
                'utm_campaign' => $utm_campaign,
                'utm_content'  => $utm_content,
                'utm_term'     => $utm_term
            ];

            // Build the query string
            $query_string = http_build_query($utm_params);

            // Ensure there's a slash after the domain if not present
            $path = parse_url($link, PHP_URL_PATH);
            if (!$path) {
                $link .= '/';
            }
        
            // Check if the URL already has a query string
            $separator = (parse_url($link, PHP_URL_QUERY) == NULL) ? '?' : '&';

            // Return the URL with UTM parameters appended
            $data['text'] = $link . $separator . $query_string;

            return $data;
            
        } catch (\Exception $e) {

            session()->flash('status', 'error');
            session()->flash('message', __($e->getMessage()));
            return;
        }

	}
    //

}