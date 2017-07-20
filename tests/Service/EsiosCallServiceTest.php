<?php

namespace Esios\Tests\Service;

use PHPUnit\Framework\TestCase;
use Esios\Service\EsiosCallService;

class EsiosCallServiceTest extends TestCase {

    public static $token;
    public static $logger;

    public static function setUpBeforeClass() {

        self::$token = $_ENV['token'];

        self::$logger = new \Monolog\Logger('monolog_logger');
        $file_handler = new \Monolog\Handler\StreamHandler('./logs/app.log');
        self::$logger->pushHandler($file_handler);
        $file_handler->setLevel(\Monolog\Logger::DEBUG);
    }

    private function checkResponseStructure($decodedData, $expectedLength) {

        $this->assertInternalType('array', $decodedData, "response is not an array");
        $this->assertArrayHasKey('indicator', $decodedData, "response without indicator key");
        $this->assertArrayHasKey('values', $decodedData['indicator'], "response without values");
        $this->assertEquals($expectedLength, count($decodedData['indicator']['values']), "invalid number of values");
    }

    /**
     * @group onlinecheck
     */
    public function testGetDataFullDayWithHours() {

        //From 00:00 to 23:00 inclusive - 24 hours
        $params = [
            'start_date' => '2017-03-01T00:00',
            'end_date' => '2017-03-01T23:00',
            'time_trunc' => 'hour'
        ];

        $config = ['timeout' => 10];
        $callService = new EsiosCallService(self::$token, $config, self::$logger);

        //Test direct call to Esios REST url
        $data = $callService->getData('/indicators/1013', $params);
        $this->assertNotEmpty($data, "empty response");
        $decodedData = json_decode($data, true);
        $this->checkResponseStructure($decodedData, 24);
    }

    /**
     * @group onlinecheck
     */
    public function testGetDataFullDayWithoutHours() {

        //Assumes 00:00 if not specified, all inclusive = 25 hours
        $params = [
            'start_date' => '2017-03-01',
            'end_date' => '20170302'
        ];

        $config = ['timeout' => 10];
        $callService = new EsiosCallService(self::$token, $config, self::$logger);

        //Test direct call to Esios REST url
        $data = $callService->getData('/indicators/1013', $params);
        $this->assertNotEmpty($data, "empty response");
        $decodedData = json_decode($data, true);
        $this->checkResponseStructure($decodedData, 25);
    }

    /**
     * @group onlinecheck
     */
    public function testGetDataSpringDST() {

        //From 00:00 to 23:00 inclusive = 24 hours
        //-1 hour for change to DST
        $params = [
            'start_date' => '2017-03-26T00:00',
            'end_date' => '2017-03-26T23:00'
        ];

        $config = ['timeout' => 10];
        $callService = new EsiosCallService(self::$token, $config, self::$logger);

        //Test direct call to Esios REST url
        $data = $callService->getData('/indicators/1013', $params);
        $this->assertNotEmpty($data, "empty response");
        $decodedData = json_decode($data, true);
        $this->checkResponseStructure($decodedData, 23);
    }

    /**
     * @group onlinecheck
     */
    public function testGetDataAutumnDST() {

        //From 00:00 to 23:00 inclusive = 24 hours
        //+1 extra hour added for change to DST
        $params = [
            'start_date' => '2016-10-30T00:00',
            'end_date' => '2016-10-30T23:00'
        ];

        $config = ['timeout' => 10];
        $callService = new EsiosCallService(self::$token, $config, self::$logger);

        //Test direct call to Esios REST url
        $data = $callService->getData('/indicators/1013', $params);
        $this->assertNotEmpty($data, "empty response");
        $decodedData = json_decode($data, true);
        $this->checkResponseStructure($decodedData, 25);
    }

}
