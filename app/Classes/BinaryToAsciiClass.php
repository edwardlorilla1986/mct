<?php 

namespace App\Classes;

class BinaryToAsciiClass {

	public function get_data($bin)
	{

		$ascii = "";

		$binLen = strlen($bin);

		for ($i = 0; $i < $binLen; $i += 8)
		{
			$ascii .= chr($this->onBinaryToDecimal(substr($bin, $i, 8)));
		}

			
       $data['text'] = $ascii;

       return $data;

	}

	function onBinaryToDecimal($bin)
	{
		$binLength = strlen($bin);
		$dec = 0;

		for ($i = 0; $i < $binLength; $i++)
		{
			$dec += (ord($bin[$i]) - 48) * pow(2, (($binLength - $i) - 1));
		}

		return (int)$dec;
	}

}