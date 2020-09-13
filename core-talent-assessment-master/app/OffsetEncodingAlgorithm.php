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
        $characters = self::CHARACTERS;
        for($i = 0, $l = strlen($text); $i < $l; $i++) {
            // on récupére la position de la lettre dans CHARACTERS
            $position = strpos($characters, $text[$i]);
            // on vérifie si la position est trouvé
            if ($position !== false) {
                // on calcul la position de la lettre de remplacement
                $key = $position + $this->offset;
                $key =  $key > 51 ? $key - 52 : $key;
                $text[$i] = $characters[$key];
            }
        }
        return $text;
    }

}