<?php

namespace Esios\Formatter;

/**
 * Class that knows how to validate and format a response
 * with a list of indicators 
 */
class EsiosIndicatorListFormatter extends EsiosResponseFormatter {

    /**
     * @return Array
     */
    public function format() {

        return $this->raw['indicators'];
    }

    /**
     * Expected minimum structure: $response['indicators']
     * @return bool
     */
    public function validate() {

        return (!empty($this->raw) &&
                isset($this->raw['indicators']) &&
                is_array($this->raw['indicators']));
    }

}
