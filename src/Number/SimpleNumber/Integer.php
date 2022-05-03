<?php

namespace ComposerIncludeFiles\Number\SimpleNumber;

class Integer implements ISimpleNumber {

    private $value;

    public function __construct(String $value) {
        $this->value = intval($value, 10);
    }

    public function convertToFloat() {
        return floatval($this->value);
    }

    public function getType() {
        return "INTEGER";
    }

    public function add($number) {
        return new Integer($this->value + $number->value);
    }

    public function equals($number) {
        return ($this->value === $number->value);
    }

    public static function parse(String $numberAsString) {
        // To parse an integer, convert to int then back to string and see if we get the same thing.
        $stringRepresentation = trim($numberAsString);
        return (strval(intval($stringRepresentation, 10)) === $stringRepresentation);
    }
}