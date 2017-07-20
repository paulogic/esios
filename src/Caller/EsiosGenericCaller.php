<?php

namespace Esios\Caller;

/**
 * Class that makes calls with any parameters.
 * No validations.
 */
class EsiosGenericCaller extends EsiosCaller {

    /**
     * 
     * Returns the response of the call to Esios 
     * 
     * @param String $type
     * @param array $params
     * @return Mixed
     */
    public function get($type, Array $params) {

        return $this->getData($type, $params);
    }
    

}
