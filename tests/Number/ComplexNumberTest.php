<?php

use ComposerIncludeFiles\Number\ComplexNumber;

class ComplexNumberTest extends \PHPUnit\Framework\TestCase {

    public function testAddingZeroDoesntChangeNumber() {
        $numberOne = '2+3i';
        $zero = '0+0i';

        $numberOneComplexNumber = new ComplexNumber($numberOne);
        $zeroComplexNumber = new ComplexNumber($zero);

        $this->assertEquals($numberOneComplexNumber, $numberOneComplexNumber->add($zeroComplexNumber));
    }

}
