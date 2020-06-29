<?php

/**
 * Class OffsetEncodingAlgorithm
 */
class OffsetEncodingAlgorithm implements EncodingAlgorithm
{
    /**
     * Lookup string
     */
    const CHARACTERS = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    /**
     * @var int
     */
    private $offset;

    /**
     * @param int $offset
     */
    public function __construct($offset = 13)
    {
        $this->offset = $offset;
    }

    /**
     * Encodes text by shifting each character (existing in the lookup string) by an offset (provided in the constructor)
     * Examples:
     *      offset = 1, input = "a", output = "b"
     *      offset = 2, input = "z", output = "B"
     *      offset = 1, input = "Z", output = "a"
     *
     * @param string $text
     * @return string
     */
    public function encode($text)
    {
        $newText= '';
        $characters = str_split(self::CHARACTERS);
        $text = str_split($text);
        foreach($text as $i => $letter) {
            foreach($characters as $key => $value){
                if($letter == $value){
                    $newKey = $key + $this->offset;
                    if($newKey > 51) $newKey = $newKey - 52;
                    $text[$i] = $characters[$newKey];              
                }
            } 
        }
        foreach($text as $letter) {
            $newText .= $letter;
        }
        return $newText;
    }
}