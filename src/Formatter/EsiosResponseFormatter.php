<?php

namespace Esios\Formatter;

use Esios\EsiosBase as EsiosBase;
use Psr\Log\LoggerInterface as PsrLogLoggerInterface;

/**
 * Base class for the response validators/formatters
 */
abstract class EsiosResponseFormatter extends EsiosBase {

    protected $raw; //Array
    protected $formatSelector = 'default';

    /**
     * @param $formatSelector - it may be used by the developer
     *        to decide between different formats inside the format() function.
     */
    public function setFormatSelector($formatSelector) {

        $this->formatSelector = $formatSelector;
    }

    /**
     * Assumes that the response is a json-encoded String.
     * Internally, raw is of type Array
     * 
     * @param String $raw
     */
    public function setDataFromJsonEncoded($raw) {

        $this->raw = json_decode($raw, true);
    }

    /**
     * 
     * @return String
     */
    public function getJsonEncodedData() {

        return json_encode($this->raw);
    }
    
    /**
     * Converts raw response to a convenience format.
     * @return Mixed
     */
    abstract public function format();

    /**
     * Validates that the response has the expected structure
     * before formatting it.
     * @return boolean
     */
    abstract public function validate();
}
