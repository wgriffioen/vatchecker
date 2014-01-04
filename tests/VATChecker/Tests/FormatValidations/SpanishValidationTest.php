<?php

namespace VATChecker\Tests\Validations;

use VATChecker\VATNumber;

/**
 * @package VATChecker\Tests\FormatValidations
 * @author Wim Grifioen <wgriffioen@gmail.com>
 */
class SpanishValidationTest extends \PHPUnit_Framework_TestCase
{
    public function testValidSpanishFormat()
    {
        $vatNumber = new VATNumber('ESA12345670');

        $this->assertNotEquals(VATNumber::EMPTY_VAT_NUMBER, $vatNumber->validateFormat());
        $this->assertNotEquals(VATNumber::INVALID_COUNTRY_CODE, $vatNumber->validateFormat());
        $this->assertNotEquals(VATNumber::INVALID_FORMAT, $vatNumber->validateFormat());

        $vatNumber = new VATNumber('ES012345670');

        $this->assertNotEquals(VATNumber::EMPTY_VAT_NUMBER, $vatNumber->validateFormat());
        $this->assertNotEquals(VATNumber::INVALID_COUNTRY_CODE, $vatNumber->validateFormat());
        $this->assertNotEquals(VATNumber::INVALID_FORMAT, $vatNumber->validateFormat());

        $vatNumber = new VATNumber('ESA1234567A');

        $this->assertNotEquals(VATNumber::EMPTY_VAT_NUMBER, $vatNumber->validateFormat());
        $this->assertNotEquals(VATNumber::INVALID_COUNTRY_CODE, $vatNumber->validateFormat());
        $this->assertNotEquals(VATNumber::INVALID_FORMAT, $vatNumber->validateFormat());
    }
}
 