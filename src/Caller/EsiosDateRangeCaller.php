<?php

namespace Esios\Caller;

/**
 * Class that makes calls with date ranges as parameters,
 * validates parameters and receives results grouped by date.
 */
class EsiosDateRangeCaller extends EsiosCaller {

    /**
     * Validates start_date, end_date.
     * Sets end_date to start_date + 1 day - 1 hour, if empty
     * Returns the response of the call to Esios 
     * 
     * @param String $type
     * @param array $params
     * @return Mixed
     */
    public function get($type, Array $params) {

        //mandatory: start_date
        //optional: end_date, time_trunc
        $this->assertMandatoryParams($params, ['start_date']);
        $this->assertValidParams($params);
        if (isset($params['end_date']) && $params['end_date'] == $params['start_date']) {
            unset($params['end_date']);
        }
        $params['start_date'] = $this->utils->formatDate($params['start_date']);
        if (isset($params['end_date'])) {
            $params['end_date'] = $this->utils->formatDate($params['end_date']);
        } else {
            $params['end_date'] = $this->utils->incrementOneDay($params['start_date']);
        }
        $defaults = [
            //'time_agg' => 'sum',
            'time_trunc' => 'hour',
        ];
        $params = array_merge($defaults, $params);

        return $this->getData($type, $params);
    }

}
