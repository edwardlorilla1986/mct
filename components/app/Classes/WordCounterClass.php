<?php 

namespace App\Classes;

class WordCounterClass {

    public function get_data($text)
    {
        $data = [
            'words'                  => $this->countWords($text),
            'characters'             => $this->countCharacters($text, false),
            'characters_with_spaces' => $this->countCharacters($text, true),
            'paragraphs'             => $this->countParagraphs($text),
        ];

        return $data;
    }

    /**
     * -------------------------------------------------------------------------------
     *  countWords
     * -------------------------------------------------------------------------------
    **/
    private function countWords($text)
    {
        preg_match_all('/\p{L}[\p{L}\p{Mn}\p{Pd}\x{2019}]*/u', $text, $matches);
        return count($matches[0]);
    }

    /**
     * -------------------------------------------------------------------------------
     *  countCharacters
     * -------------------------------------------------------------------------------
    **/
    private function countCharacters($text, $withSpaces = true)
    {
        if ($withSpaces) {
            return mb_strlen($text, 'UTF-8');
        }

        return mb_strlen(preg_replace('/\s+/', '', $text), 'UTF-8');
    }

    /**
     * -------------------------------------------------------------------------------
     *  countParagraphs
     * -------------------------------------------------------------------------------
    **/
    private function countParagraphs($text)
    {
        $text = preg_replace("/\n+/", "\n", $text);
        return substr_count($text, "\n") + 1;
    }

}