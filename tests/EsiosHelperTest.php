<?php

namespace Esios\Tests;

use PHPUnit\Framework\TestCase;
use Esios\Tests\Fixture\EsiosCallServiceMock;

class EsiosHelperTest extends TestCase {

    public static $token;
    
    public static function setUpBeforeClass() {

        self::$token = $_ENV['token'];
    }

    public function testGet() {

        $callService = new EsiosCallServiceMock(self::$token);
        $caller = new \Esios\Caller\EsiosDateRangeCaller($callService);
        $formatter = new \Esios\Formatter\EsiosDateValueIndicatorFormatter();
        $helper = new \Esios\EsiosHelper(
                \Esios\EsiosCallTypes::PVPC_20A_PRICES,
                $caller,
                $formatter);
        $params = [
            'start_date' => '2017-03-01'
        ];
        $data = $helper->get($params);
        $this->assertNotEmpty($data, "empty response");
        $this->assertEquals(25, count($data), "invalid number of values");
    }

    
    /**
     * @group onlinecheck
     */
    public function testGetWithoutEndDate() {

        $callService = new \Esios\Service\EsiosCallService(self::$token);
        $caller = new \Esios\Caller\EsiosDateRangeCaller($callService);
        $formatter = new \Esios\Formatter\EsiosDateValueIndicatorFormatter();
        $helper = new \Esios\EsiosHelper(
                \Esios\EsiosCallTypes::PVPC_20A_PRICES,
                $caller,
                $formatter);
        $params = [
            'start_date' => '2017-03-01',
        ];
        $data = $helper->get($params);
        $this->assertNotEmpty($data, "empty response");
        $this->assertEquals(24, count($data), "invalid number of values");
    }
    
    
}
