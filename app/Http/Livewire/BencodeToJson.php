<?php

namespace App\Http\Livewire;

use Livewire\Component;

class BencodeToJson extends Component
{
    public $bencodeInput = '';
    public $jsonOutput = '';
    public $errorMessage = '';

    public function updatedBencodeInput()
    {
        $this->convertBencodeToJson();
    }

    public function convertBencodeToJson()
    {
        try {
            $decoded = $this->bdecode($this->bencodeInput);
            
            if (!is_array($decoded)) {
                throw new \Exception('Invalid Bencode format.');
            }

            $this->jsonOutput = json_encode($decoded, JSON_PRETTY_PRINT);
            $this->errorMessage = '';
        } catch (\Exception $e) {
            $this->jsonOutput = '';
            $this->errorMessage = 'Invalid Bencode: ' . $e->getMessage();
        }
    }

    public function loadSample()
    {
        $this->bencodeInput = "d3:agei30e7:colorsl3:red5:green4:bluee4:name5:Alice7:profiled7:status6:active9:followersi500e7:website17:https://site.come";
        $this->convertBencodeToJson();
    }

    private function bdecode($bencode)
    {
        $position = 0;
        return $this->decodeElement($bencode, $position);
    }

    private function decodeElement($bencode, &$position)
    {
        if ($bencode[$position] === 'i') {
            $position++;
            $end = strpos($bencode, 'e', $position);
            $number = substr($bencode, $position, $end - $position);
            $position = $end + 1;
            return (int) $number;
        } elseif (ctype_digit($bencode[$position])) {
            $colon = strpos($bencode, ':', $position);
            $length = (int)substr($bencode, $position, $colon - $position);
            $position = $colon + 1;
            $string = substr($bencode, $position, $length);
            $position += $length;
            return $string;
        } elseif ($bencode[$position] === 'l') {
            $position++;
            $list = [];
            while ($bencode[$position] !== 'e') {
                $list[] = $this->decodeElement($bencode, $position);
            }
            $position++;
            return $list;
        } elseif ($bencode[$position] === 'd') {
            $position++;
            $dict = [];
            while ($bencode[$position] !== 'e') {
                $key = $this->decodeElement($bencode, $position);
                $value = $this->decodeElement($bencode, $position);
                $dict[$key] = $value;
            }
            $position++;
            return $dict;
        }
        throw new \Exception("Invalid Bencode format");
    }

    public function downloadJson()
    {
        return response()->streamDownload(function () {
            echo $this->jsonOutput;
        }, 'converted.json');
    }

    public function render()
    {
        return view('livewire.bencode-to-json');
    }
}

// Blade Template (resources/views/livewire/bencode-to-json.blade.php)
?>