<?php

namespace Esios;

class EsiosValidation {

    private $validatedParams = ['start_date', 'end_date', 'time_trunc', 'time_agg'];

    /**
     * Returns true or the name of the first invalid parameter
     * @param array $params
     * @return String|boolean
     */
    public function validate(Array $params) {
        foreach ($params as $name => $value) {
            if (in_array($name, $this->validatedParams)) {
                $method = "isValid" . str_replace('_', '', ucwords($name, "_"));
                if (!$this->{$method}($value)) {
                    return $name;
                }
            }
        }
        return true;
    }

    /**
     * Receives expected date iso8601
     * 
     * @param String $date
     * @return bool
     */
    public function isValidDate($date) {

        $formatted_date = date(\DateTime::ISO8601, strtotime($date));
        return (strtotime($formatted_date));
    }

    /**
     * 
     * @param String $date
     * @return bool
     */
    public function isValidStartDate($date) {

        return $this->isValidDate($date);
    }

    /**
     * 
     * @param String $date
     * @return bool
     */
    public function isValidEndDate($date) {

        return $this->isValidDate($date);
    }

    /**
     * 
     * @param String $value
     * @return bool
     */
    public function isValidTimeTrunc($value) {

        return in_array($value, ['ten_minutes', 'hour', 'day', 'month', 'year']);
    }

    /**
     * 
     * @param String $value
     * @return bool
     */
    public function isValidTimeAgg($value) {

        return in_array($value, ['sum', 'average']);
    }

}
