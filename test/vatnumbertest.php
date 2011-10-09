<?php
require_once '../lib/vatnumber.php';

class VatNumberTest extends PHPUnit_Framework_TestCase {

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
