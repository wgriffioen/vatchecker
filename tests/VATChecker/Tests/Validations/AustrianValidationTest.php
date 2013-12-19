<?php

namespace VATChecker\Tests\Validations;

use VATChecker\VATNumber;

/**
 * @package VATChecker\Tests\Validations
 * @author Wim Grifioen <wgriffioen@gmail.com>
 */
class AustrianValidationTest extends \PHPUnit_Framework_TestCase
{
    public function testInvalidAustrianFormat()
    {
        $vatNumber = new VATNumber('ATU9999999');

        $this->assertNotEquals(VATNumber::EMPTY_VAT_NUMBER, $vatNumber->validate());
        $this->assertNotEquals(VATNumber::INVALID_COUNTRY_CODE, $vatNumber->validate());
        $this->assertEquals(VATNumber::INVALID_FORMAT, $vatNumber->validate());
    }

    public function testValidAustrianFormat()
    {
        $vatNumber = new VATNumber('ATU99999999');

        $this->assertNotEquals(VATNumber::EMPTY_VAT_NUMBER, $vatNumber->validate());
        $this->assertNotEquals(VATNumber::INVALID_COUNTRY_CODE, $vatNumber->validate());
        $this->assertNotEquals(VATNumber::INVALID_FORMAT, $vatNumber->validate());
    }
} 