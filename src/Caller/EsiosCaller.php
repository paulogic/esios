<?php

namespace Esios\Caller;

use Esios\EsiosCallTypes as EsiosCallTypes;
use Esios\EsiosBase as EsiosBase;
use Esios\EsiosValidation as EsiosValidation;
use Esios\Esios_Parameter_Exception as Esios_Parameter_Exception;
use Esios\Esios_UnknownEsiosType_Exception as Esios_UnknownEsiosType_Exception;
use Esios\Service\EsiosCallServiceInterface as EsiosCallServiceInterface;
use Psr\Log\LoggerInterface as PsrLogLoggerInterface;

/*
 * Base class for the hierarchy that makes the call to the Esios API.
 * Each class knows its parameter types and how to validate them.
 */

abstract class EsiosCaller extends EsiosBase {

    private $callService;
    protected $validator;

    /**
     * 
     * @param EsiosCallServiceInterface $callService
     * @param PsrLogLoggerInterface $logger
     */
    public function __construct(
            EsiosCallServiceInterface $callService, PsrLogLoggerInterface $logger = null
    ) {

        parent::__construct($logger);
        $this->callService = $callService;
        $this->validator = new EsiosValidation;
    }

    /**
     * Utility checker
     * @param array $params
     * @param array $paramNames
     * @throws Esios_Parameter_Exception
     */
    protected function assertMandatoryParams(Array $params = [], Array $paramNames = []) {

        foreach ($paramNames as $paramName) {
            if (!isset($params[$paramName])) {
                $this->error("Mandatory parameter not found: [$paramName]");
                throw new Esios_Parameter_Exception("Mandatory parameter not found: [$paramName]");
            }
        }
    }

    /**
     * Utility checker
     * @param array $params
     * @throws Esios_Parameter_Exception
     */
    protected function assertValidParams(Array $params = []) {

        $ok = $this->validator->validate($params);
        if ($ok !== true) {
            $this->error("Bad parameter format: [$ok][${params[$ok]}]");
            throw new Esios_Parameter_Exception("Bad parameter format: [$ok][${params[$ok]}]");
        }
    }

    /**
     * @param String $call_type
     * @return String
     * @throws Esios_UnknownEsiosType_Exception
     */
    protected function getPathFromType($call_type) {

        if ($path = EsiosCallTypes::getPath($call_type)) {
            return $path;
        }
        $this->error("Unknown Esios type: [$call_type]");
        throw new Esios_UnknownEsiosType_Exception("Unknown Esios type: [$call_type]");
    }

    /**
     * 
     * @param String $type
     * @param array $params
     * @return Mixed
     */
    protected function getData($type, Array $params) {

        $path = $this->getPathFromType($type);
        return $this->callService->getData($path, $params);
    }

    /**
     * API entry point
     */
    abstract public function get($type, Array $params);
}
