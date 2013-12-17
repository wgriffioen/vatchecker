<?php
require_once '../src/VATNumber.php';

class VatNumberTest extends PHPUnit_Framework_TestCase {

    public function testEmptyVATNumber()
    {
        $vatNumber = new VATNumber('');

        $this->assertEquals($vatNumber->validate(), VATNumber::EMPTY_VAT_NUMBER);
    }

    public function testInvalidCountryCode()
    {
        $vatNumber = new VATNumber('AB123456789');

        $this->assertEquals($vatNumber->validate(), VATNumber::INVALID_COUNTRY_CODE);
        $this->assertFalse($vatNumber->isValid());
    }

    public function testValidationOfInvalidVATNumber()
    {
        $vatNumber = new VATNumber('NL821015166B01');

        $this->assertEquals(VATNumber::INVALID_VAT_NUMBER, $vatNumber->validate());
        $this->assertFalse($vatNumber->isValid());
    }

    public function testValidationOfValidVATNumber()
    {
        // Insert a valid VAT number here to make sure the tests validate
        $vatNumber = new VatNumber('');

        $this->assertEquals(VATNumber::VALID_VAT_NUMBER, $vatNumber->validate());
        $this->assertTrue($vatNumber->isValid());
    }

}
