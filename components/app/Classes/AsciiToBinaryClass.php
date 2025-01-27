<?php 

namespace App\Classes;

class AsciiToBinaryClass {

	public function get_data($str)
	{

		$bin = "";

		$strLen = strlen($str);

		for ($i = 0; $i < $strLen; $i++)
		{
			$cBin = $this->onDecimalToBinary(ord($str[$i]));

			if (strlen($cBin) < 8)
				$cBin = str_pad($cBin, 8, "0", STR_PAD_LEFT);

			$bin .= $cBin;
		}

		$data['text'] = $bin;

		return $data;

	}

	function onDecimalToBinary($dec)
	{
		if ($dec < 1) return "0";

		$binStr = "";

		while ($dec > 0)
		{
			$binStr = substr_replace($binStr, strval($dec % 2), 0, 0);

			$dec = floor($dec / 2);
		}

		return $binStr;
	}
}