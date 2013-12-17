<?php

namespace VATChecker\Tests;

use VATChecker\VATNumber;

/**
 * @package VATChecker\Tests
 * @author Wim Griffioen <wgriffioen@gmail.com>
 */
class ReturnValuesTest extends \PHPUnit_Framework_TestCase
{
    public function testEmptyNumberReturnValue()
    {
        $vatNumber = new VATNumber('');

        $this->assertEquals(VATNumber::EMPTY_VAT_NUMBER, $vatNumber->validate());

        $vatNumber = new VATNumber('xx');

        $this->assertNotEquals(VATNumber::EMPTY_VAT_NUMBER, $vatNumber->validate());
    }

    public function testInvalidCountryCodeReturnValue()
    {
        $vatNumber = new VATNumber('US');

        $this->assertEquals(VATNumber::INVALID_COUNTRY_CODE, $vatNumber->validate());

        $vatNumber = new VATNumber('NL');

        $this->assertNotEquals(VATNumber::INVALID_COUNTRY_CODE, $vatNumber->validate());
    }
}
 