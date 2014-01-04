<?php

namespace VATChecker\Tests\Validations;

use VATChecker\VATNumber;

/**
 * @package VATChecker\Tests\FormatValidations
 * @author Wim Grifioen <wgriffioen@gmail.com>
 */
class LithuanianValidationTest extends \PHPUnit_Framework_TestCase
{
    public function testValidLithuanianFormat()
    {
        $vatNumber = new VATNumber('LT123456789');

        $this->assertNotEquals(VATNumber::EMPTY_VAT_NUMBER, $vatNumber->validateFormat());
        $this->assertNotEquals(VATNumber::INVALID_COUNTRY_CODE, $vatNumber->validateFormat());
        $this->assertNotEquals(VATNumber::INVALID_FORMAT, $vatNumber->validateFormat());

        $vatNumber = new VATNumber('LT1234567890');

        $this->assertNotEquals(VATNumber::EMPTY_VAT_NUMBER, $vatNumber->validateFormat());
        $this->assertNotEquals(VATNumber::INVALID_COUNTRY_CODE, $vatNumber->validateFormat());
        $this->assertNotEquals(VATNumber::INVALID_FORMAT, $vatNumber->validateFormat());

        $vatNumber = new VATNumber('LT12345678901');

        $this->assertNotEquals(VATNumber::EMPTY_VAT_NUMBER, $vatNumber->validateFormat());
        $this->assertNotEquals(VATNumber::INVALID_COUNTRY_CODE, $vatNumber->validateFormat());
        $this->assertNotEquals(VATNumber::INVALID_FORMAT, $vatNumber->validateFormat());

        $vatNumber = new VATNumber('LT12345678902');

        $this->assertNotEquals(VATNumber::EMPTY_VAT_NUMBER, $vatNumber->validateFormat());
        $this->assertNotEquals(VATNumber::INVALID_COUNTRY_CODE, $vatNumber->validateFormat());
        $this->assertNotEquals(VATNumber::INVALID_FORMAT, $vatNumber->validateFormat());
    }
}
 