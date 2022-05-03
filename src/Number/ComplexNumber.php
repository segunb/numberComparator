<?php

namespace ComposerIncludeFiles\Number;

use ComposerIncludeFiles\INumber;

class ComplexNumber implements INumber {

    private $realPart;
    private $imaginaryPart;

    private const ZERO_COMPLEX_NUMBER = "0 + 0i";
    private const IMAGINARY_PART_SYMBOL = 'i';

    public function __construct($numberAsString) {
        $this->createFromString(str_replace(' ', '', $numberAsString));
    }

    public function getType() {
        return "COMPLEX NUMBER";
    }

    protected function getRealPart() { return $this->realPart; }
    protected function getImaginaryPart() { return $this->imaginaryPart; }

    public function add($number) {
        $sum = new self(self::ZERO_COMPLEX_NUMBER);

        $sum->imaginaryPart = $this->getImaginaryPart() + $number->getImaginaryPart();
        $sum->realPart = $this->getRealPart() + $number->getRealPart();

        return $sum;
    }

    public static function createFromFloat($floatValue) {
        $sign = ($floatValue < 0.0) ? '-' : '+';
        $complexNumberAsString = $floatValue . $sign . '0.0' . self::IMAGINARY_PART_SYMBOL;
        $newComplexNumber = new self($complexNumberAsString);
        // echo $newComplexNumber->toString() . "<br>";
        return $newComplexNumber;
    }

    private static function getComplexNumberRegEx() {
        return '/^((?P<realPart>([-+]?\d+\.?\d*|[-+]?\d*\.?\d+))\s?(?P<imaginaryPart>([-+]?\d+\.?\d*|[-+]?\d*\.?\d+[ij]?)))?$/';
    }

    public function equals(INumber $number) {
        $absoluteValueOfRealPartDifference = abs($this->realPart - $number->realPart);
        $absoluteValueOfImaginaryPartDifference = abs($this->imaginaryPart - $number->imaginaryPart);

        return
            (
                ($absoluteValueOfRealPartDifference <= self::REPRESENTATION_OF_ZERO) &&
                ( $absoluteValueOfImaginaryPartDifference <= self::REPRESENTATION_OF_ZERO)
            ) ;
    }

    public static function parse(String $numberAsString) {
        $matchResults = preg_match(self::getComplexNumberRegEx(), trim($numberAsString), $components);

        // echo var_export($components, true) . "<br><br>";

        if (1 === $matchResults){
            return true;
        }

        return false;
    }

    private function createFromString($numberAsString) {
        preg_match(self::getComplexNumberRegEx(), trim($numberAsString), $components);

        $this->realPart = floatval($components['realPart']);
        $this->imaginaryPart = floatval($components['imaginaryPart']);
    }

    public function toString() {
        return $this->getRealPart() . ' ' . $this->getImaginaryPart() . self::IMAGINARY_PART_SYMBOL;
    }
}