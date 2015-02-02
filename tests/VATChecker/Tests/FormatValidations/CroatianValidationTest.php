<?php

namespace VATChecker\Tests\Validation;

use VATChecker\VATNumber;

class CroatianValidationTest extends \PHPUnit_Framework_Testcase
{
    public function testCroationFormat()
    {
        $vatNumber = new VATNumber('HR99999999999');

        $this->assertNotEquals(VATNumber::EMPTY_VAT_NUMBER, $vatNumber->validateFormat());
        $this->assertNotEquals(VATNumber::INVALID_COUNTRY_CODE, $vatNumber->validateFormat());
        $this->assertNotEquals(VATNumber::INVALID_FORMAT, $vatNumber->validateFormat());
    }
}
