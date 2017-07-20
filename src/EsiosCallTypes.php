<?php

namespace Esios;

/**
 * Accepted call types to Esios
 * 
 */
abstract class EsiosCallTypes {

    //List of accepted calls
    const PVPC_20A_PRICES = 'PVPC_20A_PRICES';
    const PVPC_20DHA_PRICES = 'PVPC_20DHA_PRICES';
    const PVPC_20DHS_PRICES = 'PVPC_20DHS_PRICES';
    const PVPC_20A_PROFILES = 'PVPC_20A_PROFILES';
    const PVPC_20DHA_PROFILES = 'PVPC_20DHA_PROFILES';
    const PVPC_20DHS_PROFILES = 'PVPC_20DHS_PROFILES';
    const PVPC_20A_PEAJESACCESO = 'PVPC_20A_PEAJESACCESO';
    const PVPC_20DHA_PEAJESACCESO = 'PVPC_20DHA_PEAJESACCESO';
    const PVPC_20DHS_PEAJESACCESO = 'PVPC_20DHS_PEAJESACCESO';
    const INDICATORS_LIST = 'INDICATORS_LIST';

    //List of corresponding paths
    private static $paths = [
        '/indicators/1013',
        '/indicators/1014',
        '/indicators/1015',
        '/indicators/526',
        '/indicators/527',
        '/indicators/528',
        '/indicators/1018',
        '/indicators/1025',
        '/indicators/1032',
        '/indicators'
    ];

    private static function getConstants() {

        $reflect = new \ReflectionClass(get_class());
        return $reflect->getConstants();
    }

    public static function isPVPCType($type) {

        $values = array_filter(self::getConstants(),
                function($a) {
            return strpos($a, 'PVPC') !== FALSE;
        }, ARRAY_FILTER_USE_KEY
        );
        return in_array($type, $values);
    }

    public static function getPath($type) {

        $types = self::getConstants();
        if (($idx = array_search($type, array_keys($types))) !== FALSE) {
            return self::$paths[$idx];
        }
        return null;
    }

}
