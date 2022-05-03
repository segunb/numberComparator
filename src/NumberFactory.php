<?php

namespace ComposerIncludeFiles;

use ComposerIncludeFiles\Number\ComplexNumber;
use ComposerIncludeFiles\Number\SimpleNumber\Integer;
use ComposerIncludeFiles\Number\SimpleNumber\Rational;
use ComposerIncludeFiles\Number\SimpleNumber\Real;

class NumberFactory {

    public static function createNumber($numberAsString) {
        if (Integer::parse($numberAsString))
            return new Integer($numberAsString);

        if (Real::parse($numberAsString))
            return new Real($numberAsString);

        if (Rational::parse($numberAsString))
            return new Rational($numberAsString);

        if (ComplexNumber::parse($numberAsString))
            return new ComplexNumber($numberAsString);

        throw new \Exception('Unknown number type entered: ' . $numberAsString);
    }

    public static function convertToComplexNumber(INumber $number) {
        if ($number->getType() === "COMPLEX NUMBER")
            return $number;

        return ComplexNumber::createFromFloat($number->convertToFloat());
    }
}