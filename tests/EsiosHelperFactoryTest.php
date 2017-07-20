<?php

namespace Esios\Tests;

use PHPUnit\Framework\TestCase;

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

    /**
     * @group onlinecheck
     */
    public function testGetPricesWithFactory() {


        $factory = new \Esios\EsiosHelperFactory(self::$token, [], self::$logger);
        $helper = $factory->getEsiosCaller(\Esios\EsiosCallTypes::PVPC_20A_PRICES);
        $params = [
            'start_date' => '2017-01-01',
            'end_date' => '2017-01-02'
        ];
        $data = $helper->get($params);
        $this->assertNotEmpty($data, "empty response");
        $this->assertEquals(25, count($data), "invalid number of values");
    }

    /**
     * @group onlinecheck
     */
    public function testGetIndicatorsWithFactory() {

        $factory = new \Esios\EsiosHelperFactory(self::$token, [], self::$logger);
        $helper = $factory->getEsiosCaller(\Esios\EsiosCallTypes::INDICATORS_LIST);
        $params = [
            'text' => 'facturacion de energia',
        ];
        $data = $helper->get($params);
        $this->assertNotEmpty($data, "empty response");
    }

}
