<?php

namespace ComposerIncludeFiles\Number\SimpleNumber;

use ComposerIncludeFiles\INumber;

interface ISimpleNumber extends INumber {
    public function convertToFloat();
}