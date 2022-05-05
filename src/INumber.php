<?php

namespace ComposerIncludeFiles;


interface INumber {
    // Todo: Expose this as a UI parameter?
    const REPRESENTATION_OF_ZERO = 1e-7;

    public static function parse(String $numberAsString);
    public function add(INumber $number);
    public function equals(INumber $number);
    public function getType();
}