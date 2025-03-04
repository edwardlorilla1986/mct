<?php 

namespace App\Classes;
use Carbon\Carbon;

class UrlParserClass {

	public function get_data( $link )
	{

        try {

            // Parse the URL
            $parsed_url = parse_url($link);

            // Extract additional components
            $host_parts = explode('.', $parsed_url['host']);
            $file_parts = pathinfo($parsed_url['path']);

            $data = [
                'scheme'      => $parsed_url['scheme'] ?? null,
                'protocol'    => $parsed_url['scheme'] ?? null,
                'authority'   => $parsed_url['host'] ?? null,
                'host'        => $parsed_url['host'] ?? null,
                'hostname'    => $parsed_url['host'] ?? null,
                'subdomain'   => count($host_parts) > 2 ? $host_parts[0] : null,
                'domain'      => count($host_parts) > 2 ? implode('.', array_slice($host_parts, 1)) : $parsed_url['host'],
                'tld'         => end($host_parts),
                'resource'    => $parsed_url['path'] ?? null,
                'directory'   => isset($file_parts['dirname']) ? str_replace('\\', '/', $file_parts['dirname']) : null,
                'path'        => $parsed_url['path'] ?? null,
                'file_name'   => $file_parts['basename'] ?? null,
                'file_suffix' => $file_parts['extension'] ?? null
            ];

            return $data;
            
        } catch (\Exception $e) {

            session()->flash('status', 'error');
            session()->flash('message', __($e->getMessage()));
            return;
        }

	}

}