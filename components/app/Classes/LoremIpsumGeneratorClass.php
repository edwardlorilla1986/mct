<?php 

namespace App\Classes;
use joshtronic\LoremIpsum;

class LoremIpsumGeneratorClass {

	public function get_data( $type, $number, $html_markup )
	{
		$lipsum = new LoremIpsum;

		switch ($html_markup) {
			
			case 'no':
					switch ($type) {
						
						case 'words':
								$data['text'] = $lipsum->words($number);
							break;

						case 'sentences':
								$data['text'] = $lipsum->sentences($number);
							break;

						case 'paragraphs':
								$data['text'] = $lipsum->paragraphs($number);
							break;

						case 'list':
								$data['text'] = '<ul>' . $lipsum->sentences($number, '<li>$1</li>') . '</ul>';
							break;
					}
				break;

			case 'yes':
					switch ($type) {
						
						case 'words':
								$data['text'] = '<p>' . $lipsum->words($number) . '</p>';
							break;

						case 'sentences':
								$data['text'] = $lipsum->sentences($number, '<p>$1</p>');
							break;

						case 'paragraphs':
								$data['text'] = $lipsum->paragraphs($number, '<p>$1</p>');
							break;

						case 'list':
								$data['text'] = '<ul>' . $lipsum->sentences($number, '<li>$1</li>') . '</ul>';
							break;
					}
				break;
		}

		return $data;

	}
}