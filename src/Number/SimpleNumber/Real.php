<?php

namespace ComposerIncludeFiles\Number\SimpleNumber;

class Real implements ISimpleNumber {

    private $value;

    public function __construct(String $value) {
        $this->value = floatval($value);
    }

    public function convertToFloat() {
        return floatval($this->value);
    }

    public function getType() {
        return "REAL NUMBER";
    }

    public function add($number) {
        return new Real($this->value + $number->value);
    }

    public function equals($number) {
        return abs($this->value - $number->value) <= self::REPRESENTATION_OF_ZERO;
    }

    public static function parse(String $numberAsString) {
        // To parse a real number, use php is_numeric() function
        return is_numeric($numberAsString);
    }
}