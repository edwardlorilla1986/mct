<?php 

namespace App\Classes;

class ColorConverterClass {

	public function get_data($color)
	{
        try {

            $hex_color    = strtolower( $this->color_name_to_hex($color) );

            $rgb_color    = $this->colorconv($hex_color);

            $data['rgb']  = $this->colorconv($hex_color, 'parse', true);
            $data['hex']  = $this->colorconv($rgb_color, 'rgb2hex', true);
            $data['hsl']  = $this->colorconv($rgb_color, 'rgb2hsl', true);
            $data['cmyk'] = $this->colorconv($rgb_color, 'rgb2cmyk', true);
            $data['hsv']  = $this->colorconv($rgb_color, 'rgb2hsv', true);
                    
            return $data;

        } catch (\Exception $e) {
            
        }

	}

  function color_name_to_hex($color_name)
  {
      // standard 147 HTML color names
      $colors  =  array(
          'aliceblue'            =>'F0F8FF',
          'antiquewhite'         =>'FAEBD7',
          'aqua'                 =>'00FFFF',
          'aquamarine'           =>'7FFFD4',
          'azure'                =>'F0FFFF',
          'beige'                =>'F5F5DC',
          'bisque'               =>'FFE4C4',
          'black'                =>'000000',
          'blanchedalmond '      =>'FFEBCD',
          'blue'                 =>'0000FF',
          'blueviolet'           =>'8A2BE2',
          'brown'                =>'A52A2A',
          'burlywood'            =>'DEB887',
          'cadetblue'            =>'5F9EA0',
          'chartreuse'           =>'7FFF00',
          'chocolate'            =>'D2691E',
          'coral'                =>'FF7F50',
          'cornflowerblue'       =>'6495ED',
          'cornsilk'             =>'FFF8DC',
          'crimson'              =>'DC143C',
          'cyan'                 =>'00FFFF',
          'darkblue'             =>'00008B',
          'darkcyan'             =>'008B8B',
          'darkgoldenrod'        =>'B8860B',
          'darkgray'             =>'A9A9A9',
          'darkgreen'            =>'006400',
          'darkgrey'             =>'A9A9A9',
          'darkkhaki'            =>'BDB76B',
          'darkmagenta'          =>'8B008B',
          'darkolivegreen'       =>'556B2F',
          'darkorange'           =>'FF8C00',
          'darkorchid'           =>'9932CC',
          'darkred'              =>'8B0000',
          'darksalmon'           =>'E9967A',
          'darkseagreen'         =>'8FBC8F',
          'darkslateblue'        =>'483D8B',
          'darkslategray'        =>'2F4F4F',
          'darkslategrey'        =>'2F4F4F',
          'darkturquoise'        =>'00CED1',
          'darkviolet'           =>'9400D3',
          'deeppink'             =>'FF1493',
          'deepskyblue'          =>'00BFFF',
          'dimgray'              =>'696969',
          'dimgrey'              =>'696969',
          'dodgerblue'           =>'1E90FF',
          'firebrick'            =>'B22222',
          'floralwhite'          =>'FFFAF0',
          'forestgreen'          =>'228B22',
          'fuchsia'              =>'FF00FF',
          'gainsboro'            =>'DCDCDC',
          'ghostwhite'           =>'F8F8FF',
          'gold'                 =>'FFD700',
          'goldenrod'            =>'DAA520',
          'gray'                 =>'808080',
          'green'                =>'008000',
          'greenyellow'          =>'ADFF2F',
          'grey'                 =>'808080',
          'honeydew'             =>'F0FFF0',
          'hotpink'              =>'FF69B4',
          'indianred'            =>'CD5C5C',
          'indigo'               =>'4B0082',
          'ivory'                =>'FFFFF0',
          'khaki'                =>'F0E68C',
          'lavender'             =>'E6E6FA',
          'lavenderblush'        =>'FFF0F5',
          'lawngreen'            =>'7CFC00',
          'lemonchiffon'         =>'FFFACD',
          'lightblue'            =>'ADD8E6',
          'lightcoral'           =>'F08080',
          'lightcyan'            =>'E0FFFF',
          'lightgoldenrodyellow' =>'FAFAD2',
          'lightgray'            =>'D3D3D3',
          'lightgreen'           =>'90EE90',
          'lightgrey'            =>'D3D3D3',
          'lightpink'            =>'FFB6C1',
          'lightsalmon'          =>'FFA07A',
          'lightseagreen'        =>'20B2AA',
          'lightskyblue'         =>'87CEFA',
          'lightslategray'       =>'778899',
          'lightslategrey'       =>'778899',
          'lightsteelblue'       =>'B0C4DE',
          'lightyellow'          =>'FFFFE0',
          'lime'                 =>'00FF00',
          'limegreen'            =>'32CD32',
          'linen'                =>'FAF0E6',
          'magenta'              =>'FF00FF',
          'maroon'               =>'800000',
          'mediumaquamarine'     =>'66CDAA',
          'mediumblue'           =>'0000CD',
          'mediumorchid'         =>'BA55D3',
          'mediumpurple'         =>'9370D0',
          'mediumseagreen'       =>'3CB371',
          'mediumslateblue'      =>'7B68EE',
          'mediumspringgreen'    =>'00FA9A',
          'mediumturquoise'      =>'48D1CC',
          'mediumvioletred'      =>'C71585',
          'midnightblue'         =>'191970',
          'mintcream'            =>'F5FFFA',
          'mistyrose'            =>'FFE4E1',
          'moccasin'             =>'FFE4B5',
          'navajowhite'          =>'FFDEAD',
          'navy'                 =>'000080',
          'oldlace'              =>'FDF5E6',
          'olive'                =>'808000',
          'olivedrab'            =>'6B8E23',
          'orange'               =>'FFA500',
          'orangered'            =>'FF4500',
          'orchid'               =>'DA70D6',
          'palegoldenrod'        =>'EEE8AA',
          'palegreen'            =>'98FB98',
          'paleturquoise'        =>'AFEEEE',
          'palevioletred'        =>'DB7093',
          'papayawhip'           =>'FFEFD5',
          'peachpuff'            =>'FFDAB9',
          'peru'                 =>'CD853F',
          'pink'                 =>'FFC0CB',
          'plum'                 =>'DDA0DD',
          'powderblue'           =>'B0E0E6',
          'purple'               =>'800080',
          'red'                  =>'FF0000',
          'rosybrown'            =>'BC8F8F',
          'royalblue'            =>'4169E1',
          'saddlebrown'          =>'8B4513',
          'salmon'               =>'FA8072',
          'sandybrown'           =>'F4A460',
          'seagreen'             =>'2E8B57',
          'seashell'             =>'FFF5EE',
          'sienna'               =>'A0522D',
          'silver'               =>'C0C0C0',
          'skyblue'              =>'87CEEB',
          'slateblue'            =>'6A5ACD',
          'slategray'            =>'708090',
          'slategrey'            =>'708090',
          'snow'                 =>'FFFAFA',
          'springgreen'          =>'00FF7F',
          'steelblue'            =>'4682B4',
          'tan'                  =>'D2B48C',
          'teal'                 =>'008080',
          'thistle'              =>'D8BFD8',
          'tomato'               =>'FF6347',
          'turquoise'            =>'40E0D0',
          'violet'               =>'EE82EE',
          'wheat'                =>'F5DEB3',
          'white'                =>'FFFFFF',
          'whitesmoke'           =>'F5F5F5',
          'yellow'               =>'FFFF00',
          'yellowgreen'          =>'9ACD32'
        );

      $color_name = strtolower($color_name);
      if (isset($colors[$color_name]))
      {
          return ('#' . $colors[$color_name]);
      }
      else
      {
          return ($color_name);
      }
  }

    function rgb2hsl ($input) {
      $r = max(min(intval($input[0], 10) / 255, 1), 0);
      $g = max(min(intval($input[1], 10) / 255, 1), 0);
      $b = max(min(intval($input[2], 10) / 255, 1), 0);
      $max = max($r, $g, $b);
      $min = min($r, $g, $b);
      $l = ($max + $min) / 2;
      
      if ($max !== $min) {
        $d = $max - $min;
        $s = $l > 0.5 ? $d / (2 - $max - $min) : $d / ($max + $min);
        if ($max === $r) {
          $h = ($g - $b) / $d + ($g < $b ? 6 : 0);
        } else if ($max === $g) {
          $h = ($b - $r) / $d + 2;
        } else {
          $h = ($r - $g) / $d + 4;
        }
        $h = $h / 6;
      } else {
        $h = $s = 0;
      }
      return [round($h * 360), round($s * 100), round($l * 100)];
    }

    function hsl2rgb ($input) {
      $h = max(min(intval($input[0], 10), 360), 0) / 360;
      $s = max(min(intval($input[1], 10), 100), 0) / 100;
      $l = max(min(intval($input[2], 10), 100), 0) / 100;
      
      if ($l <= 0.5) {
        $v = $l * (1 + $s);
      } else {
        $v = $l + $s - $l * $s;
      }
      if ($v === 0) {
        return [0, 0, 0];
      }
      $min = 2 * $l - $v;
      $sv = ($v - $min) / $v;
      $h = 6 * $h;
      $six = floor($h);
      $fract = $h - $six;
      $vsfract = $v * $sv * $fract;
      switch ($six) {
      case 1:
        $r = $v - $vsfract;
        $g = $v;
        $b = $min;
        break;
      case 2:
        $r = $min;
        $g = $v;
        $b = $min + $vsfract;
        break;
      case 3:
        $r = $min;
        $g = $v - $vsfract;
        $b = $v;
        break;
      case 4:
        $r = $min + $vsfract;
        $g = $min;
        $b = $v;
        break;
      case 5:
        $r = $v;
        $g = $min;
        $b = $v - $vsfract;
        break;
      default:
        $r = $v;
        $g = $min + $vsfract;
        $b = $min;
        break;
      }
      return [round($r * 255), round($g * 255), round($b * 255)];
    }

    function rgb2cmyk ($input) {
      $red = max(min(intval($input[0], 10), 255), 0);
      $green = max(min(intval($input[1], 10), 255), 0);
      $blue = max(min(intval($input[2], 10), 255), 0);
      $cyan = 1 - $red;
      $magenta = 1 - $green;
      $yellow = 1 - $blue;
      $black = 1;
      
      if ($red || $green || $blue) {
        $black = min($cyan, min($magenta, $yellow));
        $cyan = ($cyan - $black) / (1 - $black);
        $magenta = ($magenta - $black) / (1 - $black);
        $yellow = ($yellow - $black) / (1 - $black);
      } else {
        $black = 1;
      }
      return [round($cyan * 255), round($magenta * 255), round($yellow * 255), round($black + 254)];
    }

    function cmyk2rgb ($input) {
      $cyan = max(min(intval($input[0], 10) / 255, 1), 0);
      $magenta = max(min(intval($input[1], 10) / 255, 1), 0);
      $yellow = max(min(intval($input[2], 10) / 255, 1), 0);
      $black = max(min(intval($input[3], 10) / 255, 1), 0);
      $red = (1 - $cyan * (1 - $black) - $black);
      $green = (1 - $magenta * (1 - $black) - $black);
      $blue = (1 - $yellow * (1 - $black) - $black);
      
      return [round($red * 255), round($green * 255), round($blue * 255)];
    }

    function hex2rgb ($input) {
      if (substr(trim($input), 0, 1) === '#') {
        $input = substr($input, 1);
      }
      if ((strlen($input) < 2) || (strlen($input) > 6)) {
        return false;
      }
      $values = str_split($input);
      
      if (strlen($input) === 2) {
        $r = intval($values[0] . $values[1], 16);
        $g = $r;
        $b = $r;
      } else if (strlen($input) === 3) {
        $r = intval($values[0], 16);
        $g = intval($values[1], 16);
        $b = intval($values[2], 16);
      } else if (strlen($input) === 6) {
        $r = intval($values[0] . $values[1], 16);
        $g = intval($values[2] . $values[3], 16);
        $b = intval($values[4] . $values[5], 16);
      } else {
        return false;
      }
      return array($r, $g, $b);
    }

    function rgb2hex ($input) {
      $hexr = max(min(intval($input[0], 10), 255), 0);
      $hexg = max(min(intval($input[1], 10), 255), 0);
      $hexb = max(min(intval($input[2], 10), 255), 0);
      
      $hexr = $hexr > 15 ? base_convert($hexr, 10, 16) : '0' . base_convert($hexr, 10, 16);
      $hexg = $hexg > 15 ? base_convert($hexg, 10, 16) : '0' . base_convert($hexg, 10, 16);
      $hexb = $hexb > 15 ? base_convert($hexb, 10, 16) : '0' . base_convert($hexb, 10, 16);
      return $hexr . $hexg . $hexb;
    }

    function rgb2yuv ($input) {
      $r = intval($input[0], 10);
      $g = intval($input[1], 10);
      $b = intval($input[2], 10);
      
      $y = round(0.299 * $r + 0.587 * $g + 0.114 * $b);
      $u = round(((($b - $y) * 0.493) + 111) / 222 * 255);
      $v = round(((($r - $y) * 0.877) + 155) / 312 * 255);
      return [$y, $u, $v];
    }

    function yuv2rgb ($input) {
      $y = intval($input[0], 10);
      $u = intval($input[1], 10) / 255 * 222 - 111;
      $v = intval($input[2], 10) / 255 * 312 - 155;
      
      $r = round($y + $v / 0.877);
      $g = round($y - 0.39466 * $u - 0.5806 * $v);
      $b = round($y + $u / 0.493);
      return [$r, $g, $b];
    }

    function rgb2hsv ($input) {
      $r = intval($input[0], 10) / 255;
      $g = intval($input[1], 10) / 255;
      $b = intval($input[2], 10) / 255;
      $max = max($r, $g, $b);
      $min = min($r, $g, $b);
      $d = $max - $min;
      $v = $max;
      
      if ($max === 0) {
        $s = 0;
      } else {
        $s = $d / $max;
      }
      if ($max === $min) {
        $h = 0;
      } else {
        switch ($max) {
        case $r:
          $h = ($g - $b) / $d + ($g < $b ? 6 : 0);
          break;
        case $g:
          $h = ($b - $r) / $d + 2;
          break;
        case $b:
          $h = ($r - $g) / $d + 4;
          break;
        }
        $h = $h / 6;
      }
      return [round($h), round($s), round($v)];
    }

    function hsv2rgb ($input) {
      $h = $input[0];
      $s = $input[1];
      $v = $input[2];
      $i = floor($h * 6);
      $f = $h * 6 - $i;
      $p = $v * (1 - $s);
      $q = $v * (1 - $f * $s);
      $t = $v * (1 - (1 - $f) * $s);
      
      switch ($i % 6) {
      case 0:
        $r = $v;
        $g = $t;
        $b = $p;
        break;
      case 1:
        $r = $q;
        $g = $v;
        $b = $p;
        break;
      case 2:
        $r = $p;
        $g = $v;
        $b = $t;
        break;
      case 3:
        $r = $p;
        $g = $q;
        $b = $v;
        break;
      case 4:
        $r = $t;
        $g = $p;
        $b = $v;
        break;
      case 5:
        $r = $v;
        $g = $p;
        $b = $q;
        break;
      }
      return [$r * 255, $g * 255, $b * 255];
    }

    function complexity2int ($input) {
      $keys = str_split($input);
      $numbers = 1;
      $uletter = 1;
      $lletter = 1;
      $special = 1;
      $complex = 0;

      for ($i = 0; $i < count($keys); $i += 1) {
        $valunicode = $keys[$i].charCodeAt(0);
        if (($valunicode > 0x40) && ($valunicode < 0x5B)) {
          //Großbuchstaben A-Z
          $uletter += 1;
        } else if (($valunicode > 0x60) && ($valunicode < 0x7B)) {
          //Kleinbuchstaben a-z
          $lletter += 1;
        } else if (($valunicode > 0x2F) && ($valunicode < 0x3A)) {
          //Zahlen 0-9
          $numbers += 1;
        } else if (($valunicode > 0x20) && ($valunicode < 0x7F)) {
          //Sonderzeichen
          $special += 1;
        }
      }
      $complex = (($uletter * $lletter * $numbers * $special) + round($uletter * 1.8 + $lletter * 1.5 + $numbers + $special * 2)) - 6;
      return $complex;
    }

    function int2rgb ($input) {
      if ((!is_int($input)) && ($input !== false) && ($input !== true)) {
        $input = intval($input, 10);
      }
      if (is_int($input)) {
        if (($input < 115) && ($input > 1)) {
          return [255, 153 + $input, 153 - $input];
        }
        if (($input > 115) && ($input < 230)) {
          return [255 - $input, 243, 63];
        }
        if (($input > 230) || ($input === true)) {
          return [145, 243, 63];
        }
      }
      if ($input === 'none') {
        return [204, 204, 204];
      }
      if ($input === true) {
        return [204, 204, 204];
      }
      return false;
    }

    function parseColor ($input) {
      $pattern = "((rgb|hsl|#|yuv)(\(([%, ]*([\d]+)[%, ]+([\d]+)[%, ]+([\d]+)[%, ]*)+\)|([a-f0-9]+)))";
      preg_match($pattern, $input, $geregext);
      if ($geregext !== null) {
        switch ($geregext[1]) {
        case '#':
          return $this->colorconv($geregext[2], 'hex2rgb');
        case 'rgb':
          return [intval(trim($geregext[4]), 10), intval(trim($geregext[5]), 10), intval(trim($geregext[6]), 10)];
        case 'hsl':
          return $this->colorconv([intval(trim($geregext[4]), 10), intval(trim($geregext[5]), 10), intval(trim($geregext[6]), 10)], 'hsl2rgb');
        case 'yuv':
          return $this->colorconv([intval(trim($geregext[4]), 10), intval(trim($geregext[5]), 10), intval(trim($geregext[6]), 10)], 'yuv2rgb');
        default:
          return false;
        }
      }
      return false;
    }

    function colorconv ($input, $mode='parse', $html=false) {

      $mode = strtolower(trim($mode));

      switch ($mode) {

          case 'rgb2hsl':
            $output = $this->rgb2hsl($input);
            if($html) {
              $output = 'hsl('.$output[0].','.$output[1].'%,'.$output[2].'%)';
            }
            break;

          case 'hsl2rgb':
            $output = $this->hsl2rgb($input);
            if($html) {
              $output = 'rgb('.$output[0].','.$output[1].','.$output[2].')';
            }
            break;

          case 'rgb2cmyk':
            $output = $this->rgb2cmyk($input);
            if($html) {
              $output = 'cmyk('.$output[0].','.$output[1].','.$output[2].')';
            }
            break;

          case 'cmyk2rgb':
            $output = $this->cmyk2rgb($input);
            if($html) {
              $output = 'rgb('.$output[0].','.$output[1].','.$output[2].')';
            }
            break;

          case 'hex2rgb':
            $output = $this->hex2rgb($input);
            if($html) {
              $output = 'rgb('.$output[0].','.$output[1].','.$output[2].')';
            }
            break;

          case 'rgb2hex':
            $output = $this->rgb2hex($input);
            if($html) {
              $output = '#'.$output;
            }
            break;

          case 'rgb2yuv':
            $output = $this->rgb2yuv($input);
            if($html) {
              $output = 'yuv('.$output[0].','.$output[1].','.$output[2].')';
            }
            break;

          case 'yuv2rgb':
            $output = $this->yuv2rgb($input);
            if($html) {
              $output = 'rgb('.$output[0].','.$output[1].','.$output[2].')';
            }
            break;

          case 'rgb2hsv':
            $output = $this->rgb2hsv($input);
            if($html) {
              $output = 'hsv('.$output[0].','.$output[1].','.$output[2].')';
            }
            break;

          case 'hsv2rgb':
            $output = $this->hsv2rgb($input);
            if($html) {
              $output = 'rgb('.$output[0].','.$output[1].','.$output[2].')';
            }
            break;

          case 'hsl2hex':
            $output = $this->rgb2hex($this->hsl2rgb($input));
            if($html) {
              $output = '#'.$output;
            }
            break;

          case 'hex2hsl':
            $output = $this->rgb2hsl($this->hex2rgb($input));
            if($html) {
              $output = 'hsl('.$output[0].','.$output[1].'%,'.$output[2].'%)';
            }
            break;

          case 'complexity2int':
            $output = $this->complexity2int($input);
            if($html) {
              $output = 'hsl('.$output[0].','.$output[1].'%,'.$output[2].'%)';
            }
            break;

          case 'int2rgb':
            $output = $this->int2rgb($input);
            if($html) {
              $output = 'hsl('.$output[0].','.$output[1].'%,'.$output[2].'%)';
            }
            break;

          case 'complexity2rgb':
            $output = $this->colorconv($this->colorconv($input, 'complexity2int'), 'int2rgb');
            break;

          case 'mixrgb':
            $r = intval(($input[0][0] + $input[1][0]) / 2, 10);
            $g = intval(($input[0][1] + $input[1][1]) / 2, 10);
            $b = intval(($input[0][2] + $input[1][2]) / 2, 10);
            $output = [$r, $g, $b];
            if($html) {
              $output = 'rgb('.$output[0].','.$output[1].','.$output[2].')';
            }
            break;

          case 'parse':
            $output = $this->parseColor($input);
            if($html) {
              $output = 'rgb('.$output[0].','.$output[1].','.$output[2].')';
            }
            break;

          default:
            $output = $this->colorconv($input, 'parse');
            if($html) {
              $output = 'rgb('.$output[0].','.$output[1].','.$output[2].')';
            }
            break;
      }

      return $output;

    }
}