<?php

/**
 * @author wgriffioen
 */
class VATNumber
{

    const RESPONSE_TIMEOUT = 5;

    const INVALID_COUNTRY_CODE = 1;
    const INVALID_FORMAT = 2;
    const UNABLE_TO_CHECK = 3;
    const VALID_VAT_NUMBER = 4;
    const INVALID_VAT_NUMBER = 5;
    const EMPTY_VAT_NUMBER = 6;


    /**
     * @access private
     * @var string Contains the first two characters of the input of the constructor
     */
    private $countryCode;

    /**
     * @access private
     * @var string Contains the part of the VAT-number after the country code
     */
    private $vatNumber;

    /**
     * @access private
     * @var string Will contain the input of the constructor
     */
    private $input;

    /**
     * @access private
     * @var array Contains all the regular expressions for all the possible VAT-numbers
     */
    private $countrys = array(
        'AT' => '/ATU[0-9]{8}/',
        'BE' => '/BE0[0-9]{9}/',
        'BG' => '/BG[0-9]{9,10}/',
        'CY' => '/CY[0-9]{8}L/',
        'CZ' => '/CZ[0-9]{8,10}/',
        'DE' => '/DE[0-9]{9}/',
        'DK' => '/DK[0-9]{2}\s?[0-9]{2}\s?[0-9]{2}\s?[0-9]{2}/',
        'EE' => '/EE[0-9]{9}/',
        'EL' => '/EL[0-9]{9}/',
        'ES' => '/ES[A-Z0-9][0-9]{7}[A-Z0-9]/',
        'FI' => '/FI[0-9]{8}/',
        'FR' => '/FR[A-Z]{2}\s?[0-9]{9}/',
        'GB' => array('/GB[0-9]{3}\s?[0-9]{4}\s?[0-9]{2}/',
                      '/GB[0-9]{3}\s?[0-9]{4}\s?[0-9]{2}\s?[0-9]{3}/',
                      '/GB(HA|GD)[0-9]{3}/'),
        'HU' => '/HU[0-9]{8}/',
        'IE' => '/IE[0-9][A-Z0-9][0-9]{5}[A-Z]/',
        'IT' => '/IT[0-9]{11}/',
        'LT' => '/LT([0-9]{9,12})/',
        'LU' => '/LU[0-9]{8}/',
        'LV' => '/LV[0-9]{11}/',
        'MT' => '/MT[0-9]{8}/',
        'NL' => '/NL[0-9]{9}B[0-9]{2}/',
        'PL' => '/PL[0-9]{10}/',
        'PT' => '/PT[0-9]{9}/',
        'RO' => '/RO[0-9]{9}/',
        'SE' => '/SE[0-9]{12}/',
        'SI' => '/SI[0-9]{8}/',
        'SK' => '/SK[0-9]{10}/'
    );

    /**
     * Constructor
     *
     * Stores the countrycode and the actual VAT-number in the class
     * variables.
     *
     * @access public
     * @param string $vatNumber The VAT-Number to be checked
     */
    public function __construct($vatNumber)
    {
        // Set the default_socket_timeout
        ini_set('default_socket_timeout', self::RESPONSE_TIMEOUT);

        // Entire input
        $this->input = str_replace('.', '', $vatNumber);
        $this->input = strtoupper($this->input);

        // Country code
        $this->countryCode = strtoupper(substr($vatNumber, 0, 2));

        // Actual number
        $this->vatNumber = substr($vatNumber, 2, strlen($vatNumber));
    }

    /**
     * Checks the validity of the VAT-number.
     *
     * If the VAT-Number is not valid, it will return an integer which
     * describe the reason why the VAT-number is invalid.
     *
     * @access public
     * @return integer
     */
    public function validate()
    {
        // Check if the VAT-number has been entered
        if (strlen($this->input) == 0) {
            return self::EMPTY_VAT_NUMBER;
        }

        // Check if the country code exists
        if (!isset($this->countrys[$this->countryCode])) {
            return self::INVALID_COUNTRY_CODE;
        }

        // Store the regex or array of multiple regexes in local variable
        $regex = $this->countrys[$this->countryCode];

        // Match the input against the regexes
        if (is_array($regex)) {
            // Multiple regexes
            foreach ($regex as $regex) {
                if (!preg_match($regex, $this->input)) {
                    return self::INVALID_FORMAT;
                }
            }
        } else {
            // Single regex
            if (!preg_match($regex, $this->input)) {
                return self::INVALID_FORMAT;
            }
        }

        // Finally check if the number is actually valid
        // This has to be done with a SOAP request
        $client = new SoapClient('http://ec.europa.eu/taxation_customs/vies/checkVatService.wsdl');

        try {
            $response = $client->checkVat(array('countryCode' => $this->countryCode,
                                               'vatNumber' => $this->vatNumber));
        } catch (SoapFault $e) {
            // In case of a timeout return VATChecker::UNABLE_TO_CHECK
            return self::UNABLE_TO_CHECK;
        }

        if ($response->valid) {
            return self::VALID_VAT_NUMBER;
        } else {
            return self::INVALID_VAT_NUMBER;
        }
    }

    /**
     * Checks if the VAT-number is valid.
     *
     * If it's not valid, it will not tell why it isn't valid.
     *
     * @access public
     * @return boolean
     */
    public function isValid()
    {
        return $this->validate() === self::VALID_VAT_NUMBER;
    }
}

?>
