<?php

namespace VATChecker\Tests\Validations;

use VATChecker\VATNumber;

/**
 * @package VATChecker\Tests\Validations
 * @author Wim Grifioen <wgriffioen@gmail.com>
 */
class DutchValidationTest extends \PHPUnit_Framework_TestCase
{
    public function testInvalidDutchFormat()
    {
        $vatNumber = new VATNumber('NL123456789');

        $this->assertNotEquals(VATNumber::EMPTY_VAT_NUMBER, $vatNumber->validate());
        $this->assertNotEquals(VATNumber::INVALID_COUNTRY_CODE, $vatNumber->validate());
        $this->assertEquals(VATNumber::INVALID_FORMAT, $vatNumber->validate());
    }

    public function testValidDutchFormat()
    {
        $vatNumber = new VATNumber('NL999999999B99');

        $this->assertNotEquals(VATNumber::EMPTY_VAT_NUMBER, $vatNumber->validate());
        $this->assertNotEquals(VATNumber::INVALID_COUNTRY_CODE, $vatNumber->validate());
        $this->assertNotEquals(VATNumber::INVALID_FORMAT, $vatNumber->validate());
    }
}
 