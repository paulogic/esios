<?php

namespace Esios;

use Esios\EsiosUtils as EsiosUtils;
use Psr\Log\LoggerInterface as PsrLogLoggerInterface;

/**
 * Accepts a psr-3 compatible logger
 * Makes utils available to the hierarchy
 */
class EsiosBase {

    protected $utils;
    private $logger;

    public function __construct(PsrLogLoggerInterface $logger = null) {

        $this->logger = $logger;
        $this->utils = new EsiosUtils;
    }

    /**
     * 
     * @param String $message
     */
    protected function debug($message) {
        if ($this->logger) {
            $this->logger->debug($message);
        }
    }

    /**
     * 
     * @param String $message
     */
    protected function error($message) {
        if ($this->logger) {
            $this->logger->error($message);
        }
    }

}

class Esios_Exception extends \Exception {
    
}

class Esios_Parameter_Exception extends Esios_Exception {
    
}

class Esios_Call_Exception extends Esios_Exception {
    
}

class Esios_ResponseFormat_Exception extends Esios_Exception {
    
}

class Esios_UnknownEsiosType_Exception extends Esios_Exception {
    
}
