<?php

namespace Esios;

use Esios\Formatter\EsiosResponseFormatter as EsiosResponseFormatter;
use Esios\Caller\EsiosCaller as EsiosCaller;
use Psr\Log\LoggerInterface as PsrLogLoggerInterface;

class EsiosHelper extends EsiosBase {

    private $esiosCaller;
    private $formatter;
    private $type;
    private $formatted = true;

    public function __construct(
    $type, EsiosCaller $esiosCaller, EsiosResponseFormatter $formatter, PsrLogLoggerInterface $logger = null) {

        parent::__construct($logger);
        $this->type = $type;
        $this->esiosCaller = $esiosCaller;
        $this->formatter = $formatter;
    }

    /**
     * Sets if the result must be formatted by the default formatter
     * or returned as it is.
     * @param bool $value
     */
    public function setFormatted($value) {

        $this->formatted = $value;
    }

    /**
     * Main logic
     * @param array $params
     * @return Mixed
     * @throws Esios_ResponseFormat_Exception
     */
    public function get(Array $params) {

        $data = $this->esiosCaller->get($this->type, $params);
        if ($this->formatted) {
            $this->formatter->setDataFromJsonEncoded($data);
            if ($this->formatter->validate()) {
                return $this->formatter->format();
            }
            throw new Esios_ResponseFormat_Exception("Unexpected response format: " . $this->formatter->getJsonEncodedData());
        }
        return $data;
    }

}
