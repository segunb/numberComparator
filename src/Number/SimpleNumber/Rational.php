<?php

namespace ComposerIncludeFiles\Number\SimpleNumber;

class Rational implements ISimpleNumber {

    private $numerator;
    private $denominator;

    public function __construct(String $value) {
        $this->createFromString($value);
    }

    public function convertToFloat() {
        if ($this->denominator == 0)
            return floatval(0);

        return floatval($this->numerator) / floatval($this->denominator);
    }

    public function getType() {
        return "RATIONAL NUMBER";
    }

    public function add($number) {
        $commonDenominator = $this->denominator * $number->denominator;
        $numeratorOfSum = $this->numerator * $number->denominator + $number->numerator * $this->denominator;

        $result = new Rational('');
        $result->numerator = $numeratorOfSum;
        $result->denominator = $commonDenominator;

        return $result;
    }

    public function equals($number) {
        $diff = abs(($this->numerator / $this->denominator) - ($number->numerator / $number->denominator));
        return ($diff <= self::REPRESENTATION_OF_ZERO);
    }

    public static function parse(String $numberAsString) {
        $matchResults = preg_match(self::getFractionRegEx(), trim($numberAsString), $components);

        if (1 === $matchResults){
            return true;
        }

        return false;
    }

    private static function getFractionRegEx() {
        // return '/^(?P<whole>\d+)?\s?((?P<numerator>\d+)\/(?P<denominator>\d+))?$/';
        return '/^((?P<numerator>\d+)\/(?P<denominator>\d+))?$/';
    }

    private function createFromString($fractionAsString) {
        preg_match(self::getFractionRegEx(), trim($fractionAsString), $components);

        // Extract whole number, numerator, and denominator components
        // $whole = $components['whole'] ?: 0;
        $numerator = $components['numerator'] ?: 0;
        $denominator = $components['denominator'] ?: 0;

        if (($numerator == 0) || ($denominator == 0)) {
            $this->numerator = 0;
            $this->denominator = 1;
        } else {
            $this->numerator = intval($numerator, 10);
            $this->denominator = intval($denominator, 10);
        }

        // echo "Creating fraction: " . $this->numerator . "/" . $this->denominator . " from " . $fractionAsString . var_export($components, true) . "<br>";
    }
}