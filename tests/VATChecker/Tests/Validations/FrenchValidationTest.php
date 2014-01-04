<?php

namespace VATChecker\Tests\Validations;

use VATChecker\VATNumber;

/**
 * @package VATChecker\Tests\Validations
 * @author Wim Grifioen <wgriffioen@gmail.com>
 */
class FrenchValidationTest extends \PHPUnit_Framework_TestCase
{
    public function testValidFrenchFormat()
    {
        $vatNumber = new VATNumber('FRAB123456789');

        $this->assertNotEquals(VATNumber::EMPTY_VAT_NUMBER, $vatNumber->validate());
        $this->assertNotEquals(VATNumber::INVALID_COUNTRY_CODE, $vatNumber->validate());
        $this->assertNotEquals(VATNumber::INVALID_FORMAT, $vatNumber->validate());

        $vatNumber = new VATNumber('FRAB 123456789');

        $this->assertNotEquals(VATNumber::EMPTY_VAT_NUMBER, $vatNumber->validate());
        $this->assertNotEquals(VATNumber::INVALID_COUNTRY_CODE, $vatNumber->validate());
        $this->assertNotEquals(VATNumber::INVALID_FORMAT, $vatNumber->validate());
    }


}
 