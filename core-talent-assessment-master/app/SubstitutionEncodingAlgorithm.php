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
        // on vérifie si toutes les lettres sont des majuscules
        $isMajuscule = ctype_upper(str_replace($noLetters, "", $text));
        foreach($this->substitutions as $substitution) {
            if($isMajuscule) {
                $substitution[0] = strtoupper($substitution[0]);
                $substitution[1] = strtoupper($substitution[1]);
            }
            // on inverse les lettres
            $trans = array($substitution[0] => $substitution[1], $substitution[1] => $substitution[0]);
            $text = strtr($text, $trans);
        }
        return $text;
    }
}