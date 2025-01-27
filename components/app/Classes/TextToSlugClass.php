<?php 

namespace App\Classes;
use Illuminate\Support\Str;

class TextToSlugClass {

	public function get_data($text)
	{

        // Replace multiple spaces and line breaks with a single space
        $text = preg_replace('/\s+/', ' ', $text);

        // Generate the slug using Laravel's Str class
        $slug = Str::slug($text, '-');

        $data['text'] = $slug;

        return $data;

	}
}