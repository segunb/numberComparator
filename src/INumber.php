<?php

namespace ComposerIncludeFiles;


interface INumber {
    const REPRESENTATION_OF_ZERO = 1e-30;

    public static function parse(String $numberAsString);
    public function add(INumber $number);
    public function equals(INumber $number);
    public function getType();
}