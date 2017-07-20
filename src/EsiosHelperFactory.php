<?php

namespace Esios;

use Esios\Caller\EsiosDateRangeCaller as EsiosDateRangeCaller;
use Esios\Caller\EsiosGenericCaller as EsiosGenericCaller;
use Esios\Formatter\EsiosDateValueIndicatorFormatter as EsiosDateValueIndicatorFormatter;
use Esios\Formatter\EsiosIndicatorListFormatter as EsiosIndicatorsListFormatter;
use Esios\Service\EsiosCallService as EsiosCallService;
use Psr\Log\LoggerInterface as PsrLogLoggerInterface;

class EsiosHelperFactory {

    protected $token;
    protected $logger;
    protected $config;

    public function __construct($token = '', Array $config = [], PsrLogLoggerInterface $logger = null) {

        $this->token = $token;
        $this->logger = $logger;
        $this->config = $config;
    }

    /**
     * Return a Helper object for the specified call with a default caller and formatter.
     * 
     * @param String $id The internal identifier of the Esios call.
     * @return Esios\EsiosHelper
     * @throws Esios_UnknownEsiosType_Exception
     */
    public function getEsiosCaller($id) {

        $callService = new EsiosCallService($this->token, $this->config, $this->logger);
        switch ($id) {
            //Date range calls that return a [date-value] response type
            case EsiosCallTypes::isPVPCType($id):
                $esiosService = new EsiosDateRangeCaller($callService, $this->logger);
                $formatter = new EsiosDateValueIndicatorFormatter($this->logger);
                $helper = new EsiosHelper($id, $esiosService, $formatter, $this->logger);
                return $helper;
            //calls that return an indicators list response type
            case EsiosCallTypes::INDICATORS_LIST:
                $esiosService = new EsiosGenericCaller($callService, $this->logger);
                $formatter = new EsiosIndicatorsListFormatter($this->logger);
                $helper = new EsiosHelper($id, $esiosService, $formatter, $this->logger);
                return $helper;
            default:
                throw new Esios_UnknownEsiosType_Exception("Unknown Esios type: $id");
        }
    }

}
