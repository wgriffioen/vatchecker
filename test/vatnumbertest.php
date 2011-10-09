<?php
require_once '../lib/vatnumber.php';

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
    }

    public function testValidationOfInvalidVATNumber()
    {
        $vatNumber = new VATNumber('AB123456789');

        $this->assertFalse($vatNumber->isValid());
    }

}
