<?php 

namespace App\Classes;

class PasswordGeneratorClass {

	public function get_data( $password_length, $uppercase, $lowercase, $numbers, $symbols )
	{
        
	    $characters = '';

		if ( $numbers    == true ) $characters .= '0123456789';
		if ( $uppercase  == true ) $characters .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		if ( $lowercase  == true ) $characters .= 'abcdefghijklmnopqrstuvwxyz';
		if ( $symbols    == true ) $characters .= '~!@#$%^&*()_+{}":?><;.,';
		if ( $characters == '' )  $characters  .= 'abcdefghijklmnopqrstuvwxyz';

	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $password_length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }

        $data['text'] = $randomString;

        return $data;

	}
}