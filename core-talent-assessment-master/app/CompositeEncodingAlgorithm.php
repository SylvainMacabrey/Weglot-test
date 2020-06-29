<?php

/**
 *  Class CompositeEncodingAlgorithm
 */
class CompositeEncodingAlgorithm implements EncodingAlgorithm
{
    /**
     * @var EncodingAlgorithm[]
     */
    private $algorithms;

    /**
     *  CompositeEncodingAlgorithm constructor
     */
    public function __construct()
    {
        $this->algorithms = array();
    }

    /**
     * @param EncodingAlgorithm $algorithm
     */
    public function add(EncodingAlgorithm $algorithm)
    {
        $this->algorithms[] = $algorithm;
    }

    /**
     *  Encodes text using multiple Encoders stored in $this->algorithms (in orders encoders were added)
     *
     * @param string $text
     * @return string
     * http://www.writephponline.com/
     */
    public function encode($text)
    {
        foreach($this->algorithms as $algorithm) {
            $text = $algorithm->encode($text);
        }
        return $text;
    }
}
