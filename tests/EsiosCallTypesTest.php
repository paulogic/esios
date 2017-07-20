<?php

namespace Esios\Tests;

use PHPUnit\Framework\TestCase;
use Esios\EsiosCallTypes;

class EsiosCallTypesTest extends TestCase {

    public function testIsPVPCType() {

        $this->assertTrue(EsiosCallTypes::isPVPCType(EsiosCallTypes::PVPC_20A_PRICES));
        $this->assertFalse(EsiosCallTypes::isPVPCType(EsiosCallTypes::INDICATORS_LIST));
    }

}
