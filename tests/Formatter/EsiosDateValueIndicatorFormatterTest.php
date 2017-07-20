<?php

namespace Esios\Tests\Formatter;

use PHPUnit\Framework\TestCase;
use Esios\Tests\Fixture\EsiosTestsFixture as Fixture;


class EsiosDateValueIndicatorFormatterTest extends TestCase {

    
    public function testDefaultFormat() {

        $formatter = new \Esios\Formatter\EsiosDateValueIndicatorFormatter();
        $formatter->setDataFromJsonEncoded(Fixture::getResponse1013());
        $this->assertTrue($formatter->validate());
        $formatted = $formatter->format();
        $this->assertEquals(25, count($formatted));
        foreach ($formatted as $key => $value) {
            $this->assertNotEmpty(strtotime(date(\DateTime::ISO8601, strtotime(key($value)))), "invalid date");
        }
    }

    public function testNestedFormat() {

        $formatter = new \Esios\Formatter\EsiosDateValueIndicatorFormatter();
        $formatter->setDataFromJsonEncoded(Fixture::getResponse1013());
        $this->assertTrue($formatter->validate());
        $formatter->setFormatSelector('nested');
        $formatted = $formatter->format();
        $this->assertEquals(1, count($formatted));//year
        $this->assertEquals(1, count(current($formatted))); //month
        $this->assertEquals(2, count(current(current($formatted)))); //days
        $day1 = current(current($formatted))[1];//day 1-3-2017
        $this->assertEquals(24, count($day1)); //hours
        $day2 = current(current($formatted))[2];//day 2-3-2017
        $this->assertEquals(count($day2), 1); //hours
        
    }
    


}
