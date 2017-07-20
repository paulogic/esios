<?php

namespace Esios\Formatter;

/**
 * Class that knows how to validate and format a response
 * from an indicator with values that are segmented by datetime.
 * 
 * Accepted formats:
 * 'default': array of [date => value]
 * 'nested': nested array broken down by year, month, day and hour
 */
class EsiosDateValueIndicatorFormatter extends EsiosResponseFormatter {

    /**
     * Format responses:
     *
     * 'default':
     * array [
     *    ['Y-m-d\TH:00' => value],
     *    ['Y-m-d\TH:00' => value],
     * ...
     * ]
     *
     * 'nested':
     * array [
     *     'yyyy' => [
     *          'mm' => [
     *              'dd' => [
     *                  'hh' => [
     *                      value, -> may have 2 values in october due to DST
     *                      value
     *                   ]
     *               ],
     *               ...
     *          ],
     *          ...
     *      ],
     *      ...
     * ]
     * @return Array
     */
    public function format() {

        return array_reduce(
                $this->raw['indicator']['values'], function ($acum, $item) {
            if ($this->formatSelector == 'nested') {
                $date = $this->utils->parseDate($item['datetime']);
                $acum[$date['year']][$date['month']][$date['day']][$date['hour']][] = $item['value'];
            } else {
                $acum[] = [$this->utils->formatDate($item['datetime']) => $item['value']];
            }
            return $acum;
        }, []);
    }

    /**
     * Expected minimum structure: $response['indicator']['values']
     * @return bool
     */
    public function validate() {

        return (!empty($this->raw) &&
                isset($this->raw['indicator']) &&
                isset($this->raw['indicator']['values']) &&
                is_array($this->raw['indicator']['values']));
    }

}
