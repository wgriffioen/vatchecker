<?php
/**
 * Created by PhpStorm.
 * User: wgriffioen
 * Date: 18-12-13
 * Time: 00:12
 */

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
        // This is the VAT number of KPN NV (http://www.kpn.nl)
        $vatNumber = new VATNumber('NL009292056B01');

        $this->assertNotEquals(VATNumber::EMPTY_VAT_NUMBER, $vatNumber->validate());
        $this->assertNotEquals(VATNumber::INVALID_COUNTRY_CODE, $vatNumber->validate());
        $this->assertNotEquals(VATNumber::INVALID_FORMAT, $vatNumber->validate());
        $this->assertEquals(VATNumber::VALID_VAT_NUMBER, $vatNumber->validate());
    }
}
 