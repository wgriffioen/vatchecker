<?php

namespace VATChecker\Tests\Validations;

use VATChecker\VATNumber;

/**
 * @package VATChecker\Tests\FormatValidations
 * @author Wim Grifioen <wgriffioen@gmail.com>
 */
class MalteseValidationTest extends \PHPUnit_Framework_TestCase
{
    public function testValidMalteseFormat()
    {
        $vatNumber = new VATNumber('MT12345678');

        $this->assertNotEquals(VATNumber::EMPTY_VAT_NUMBER, $vatNumber->validateFormat());
        $this->assertNotEquals(VATNumber::INVALID_COUNTRY_CODE, $vatNumber->validateFormat());
        $this->assertNotEquals(VATNumber::INVALID_FORMAT, $vatNumber->validateFormat());
    }
}
 