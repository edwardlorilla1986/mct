<?php 

namespace App\Classes;

class YoutubeThumbnailDownloaderClass {

	public function get_data($link)
	{

        $swt = new SWTClass();

        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[\w\-?&!#=,;]+/[\w\-?&!#=/,;]+/|(?:v|e(?:mbed)?)/|[\w\-?&!#=,;]*[?&]v=)|youtu\.be/)([\w-]{11})(?:[^\w-]|\Z)%i', $link, $videoID);

        $resolutions = array('maxresdefault', 'sddefault', 'hqdefault', 'mqdefault', 'default');
        
        return $swt->get_the_video_thumbnail($resolutions, $videoID[1]);

	}


}