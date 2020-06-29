<?php

/**
 * Class SubstitutionEncodingAlgorithm
 *  http://www.writephponline.com/
 */
class SubstitutionEncodingAlgorithm implements EncodingAlgorithm
{
    /**
     * @var array
     */
    private $substitutions;

    /**
     * SubstitutionEncodingAlgorithm constructor.
     * @param $substitutions
     */
    public function __construct(array $substitutions)
    {
        $this->substitutions = $substitutions;
    }

    /**
     * Encodes text by substituting character with another one provided in the pair.
     * For example pair "ab" defines all "a" chars will be replaced with "b" and all "b" chars will be replaced with "a"
     * Examples:
     *      substitutions = ["ab"], input = "aabbcc", output = "bbaacc"
     *      substitutions = ["ab", "cd"], input = "adam", output = "bcbm"
     *
     * @param string $text
     * @return string
     */
    public function encode($text)
    {
        $noLetters = array(" ", ".", "?", "!", "/", "=", "+", ":", ",", ";");
        $isMajuscule = ctype_upper(str_replace($noLetters, "", $text));
        $text = str_split($text);
        $newText = '';
        foreach($this->substitutions as $substitution) {
            foreach($text as $key => $letter) {
                if(($substitution[0] == $letter) || (strtoupper($substitution[0]) == $letter)) {
                    $text[$key] = $substitution[1]; 
                } else if(($substitution[1] == $letter) || (strtoupper($substitution[1]) == $letter)) {
                    $text[$key] = $substitution[0];              
                }
            }
        }
        foreach($text as $letter) {
            $newText .= $letter;
        }
        if($isMajuscule) return strtoupper($newText);
        return $newText;
    }
}