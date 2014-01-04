<?php

namespace VATChecker\Tests\Validations;

use VATChecker\VATNumber;

/**
 * @package VATChecker\Tests\Validations
 * @author Wim Grifioen <wgriffioen@gmail.com>
 */
class BritishValidationTest extends \PHPUnit_Framework_TestCase
{
    public function testValidBritishFormat()
    {
        $vatNumber = new VATNumber('GB123 1234 12');

        $this->assertNotEquals(VATNumber::EMPTY_VAT_NUMBER, $vatNumber->validate());
        $this->assertNotEquals(VATNumber::INVALID_COUNTRY_CODE, $vatNumber->validate());
        $this->assertNotEquals(VATNumber::INVALID_FORMAT, $vatNumber->validate());

        $vatNumber = new VATNumber('GB123 1234 12 123');

        $this->assertNotEquals(VATNumber::EMPTY_VAT_NUMBER, $vatNumber->validate());
        $this->assertNotEquals(VATNumber::INVALID_COUNTRY_CODE, $vatNumber->validate());
        $this->assertNotEquals(VATNumber::INVALID_FORMAT, $vatNumber->validate());

        $vatNumber = new VATNumber('GBHA123');

        $this->assertNotEquals(VATNumber::EMPTY_VAT_NUMBER, $vatNumber->validate());
        $this->assertNotEquals(VATNumber::INVALID_COUNTRY_CODE, $vatNumber->validate());
        $this->assertNotEquals(VATNumber::INVALID_FORMAT, $vatNumber->validate());

        $vatNumber = new VATNumber('GBGD123');

        $this->assertNotEquals(VATNumber::EMPTY_VAT_NUMBER, $vatNumber->validate());
        $this->assertNotEquals(VATNumber::INVALID_COUNTRY_CODE, $vatNumber->validate());
        $this->assertNotEquals(VATNumber::INVALID_FORMAT, $vatNumber->validate());
    }
}
 