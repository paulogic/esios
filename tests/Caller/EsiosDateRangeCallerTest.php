<?php

namespace Esios\Tests\Caller;

use PHPUnit\Framework\TestCase;
use Esios\Tests\Fixture\EsiosCallServiceMock;

class EsiosDateRangeCallerTest extends TestCase {

    const token = 'TOKEN';

    protected static $caller;

    public static function setUpBeforeClass() {

        $mockedCallService = new EsiosCallServiceMock(self::token);
        self::$caller = new \Esios\Caller\EsiosDateRangeCaller($mockedCallService);
    }

    public function testWrongDateValue() {

        //Expect Esios_Parameter_Exception
        $params = [
            'start_date' => '2017-03-01',
            'end_date' => '20170'
        ];

        $this->expectException(\Esios\Esios_Parameter_Exception::class);
        self::$caller->get(\Esios\EsiosCallTypes::PVPC_20A_PRICES, $params);
    }

    public function testWrongParameterName() {

        //Expect Esios_Parameter_Exception
        $params = [
            'wrong_name' => '2017-03-01',
            'end_date' => '2017-03-02'
        ];

        $this->expectException(\Esios\Esios_Parameter_Exception::class);
        self::$caller->get(\Esios\EsiosCallTypes::PVPC_20A_PRICES, $params);
    }

    public function testWrongParameterValue() {

        //Expect Esios_Parameter_Exception
        $params = [
            'start_date' => '2017-03-01',
            'end_date' => '2017-03-02',
            'time_trunc' => 'wrong'
        ];

        $this->expectException(\Esios\Esios_Parameter_Exception::class);
        self::$caller->get(\Esios\EsiosCallTypes::PVPC_20A_PRICES, $params);
    }

    public function testGetData() {

        //Assumes 00:00 if not specified, all inclusive - 25 hours
        $params = [
            'start_date' => '2017-03-01',
            'end_date' => '20170302'
        ];

        //Obtain prices
        $data = self::$caller->get(\Esios\EsiosCallTypes::PVPC_20A_PRICES, $params);

        $this->assertNotEmpty($data, "empty response");
        $decodedData = json_decode($data, true);
        $this->assertInternalType('array', $decodedData, "response is not an array");
        $this->assertArrayHasKey('indicator', $decodedData, "response without indicator key");
        $this->assertArrayHasKey('values', $decodedData['indicator'], "response without values");
        $this->assertEquals(25, count($decodedData['indicator']['values']), "invalid number of values");
    }

}
