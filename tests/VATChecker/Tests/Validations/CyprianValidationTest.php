<?php

namespace VATChecker\Tests\Validations;

use VATChecker\VATNumber;

/**
 * @package VATChecker\Tests\Validations
 * @author Wim Grifioen <wgriffioen@gmail.com>
 */
class CyprianValidationTest extends \PHPUnit_Framework_TestCase
{
    public function testValidCyprianFormat()
    {
        $vatNumber = new VATNumber('CY12345678L');

        $this->assertNotEquals(VATNumber::EMPTY_VAT_NUMBER, $vatNumber->validate());
        $this->assertNotEquals(VATNumber::INVALID_COUNTRY_CODE, $vatNumber->validate());
        $this->assertNotEquals(VATNumber::INVALID_FORMAT, $vatNumber->validate());
    }
}
 