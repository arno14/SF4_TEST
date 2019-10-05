<?php

namespace App\Form\Transformer;

use Symfony\Component\Form\DataTransformerInterface;

class ArrayToStringTransformer implements DataTransformerInterface
{
    private $separator;

    public function __construct($separator = ',')
    {
        $this->separator = $separator;
    }

    /**
     * This method is called when the form field is initialized with its default data.
     *
     * @param string[] $value The value in the original representation
     *
     * @return string The value in the transformed representation
     */
    public function transform($serverValue)
    {
        $serverValue = (array) $serverValue;

        return implode($this->separator, $serverValue);
    }

    /**
     * This method is called when {@link Form::submit()} is called to transform the requests tainted data
     * into an acceptable format.
     *
     * @param mixed $value The value in the transformed representation
     *
     * @return mixed The value in the original representation
     */
    public function reverseTransform($clientValue)
    {
        $clientValue = (string) $clientValue;

        $array = explode($this->separator, $clientValue);

        //remove blankspace before and after each item
        $array = array_map('trim', $array);
        dump($array);
        //remove empty values
        return array_filter($array);
    }
}
