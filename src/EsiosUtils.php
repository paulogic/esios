<?php

namespace Esios;

class EsiosUtils {

    const TRUNCATED_DATETIME_FORMAT = 'Y-m-d\TH:00';    //truncate minutes

    /**
     * Receives VALID date iso8601
     * Formats date to the received format (defaults to TRUNCATED_DATETIME_FORMAT)
     * 
     * @param String $date
     * @param String $format
     * @return String
     * @throws Esios_Parameter_Exception
     */

    public function formatDate($date, $format = null) {

        $format = $format ?: self::TRUNCATED_DATETIME_FORMAT;
        $formatted_date = date(\DateTime::ISO8601, strtotime($date));
        return date($format, strtotime($formatted_date));
    }

    /**
     * Receives VALID date iso8601
     * Adds +1 day -1 hour (to cover 24 hours from start_date inclusive)
     * Formats date to the received format (defaults to TRUNCATED_DATETIME_FORMAT)
     * Throws Esios_Parameter_Exception if malformed date.
     * 
     * @param String $date
     * @param String $format
     * @return String
     * @throws Esios_Parameter_Exception
     */
    public function incrementOneDay($date, $format = null) {

        $format = $format ?: self::TRUNCATED_DATETIME_FORMAT;
        $date = self::formatDate($date, $format);
        return date($format, strtotime("+ 1 day -1 hour", strtotime($date)));
    }

    /**
     * Utility, only valid for low voltage rates.
     * 
     * @param String $type ('A','DHA','DHS')
     * @param float $power
     * @return String
     */
    public function getRateIdByTypeAndPower($type, $power) {

        if ($power < 10) {
            $name = '20';
        } elseif ($power < 15) {
            $name = '21';
        } else {
            $name = '30';
        }
        return $name . '_' . $type;
    }
    
    /**
     * 
     * @param String $datetime
     * @param String $format
     * @return Array
     */
    public function parseDate ($datetime, $format = null) {
        
        $format = $format ?: self::TRUNCATED_DATETIME_FORMAT;
        return date_parse_from_format($format . "*+", $datetime);
    }

}
