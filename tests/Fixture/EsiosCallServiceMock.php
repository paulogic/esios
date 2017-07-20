<?php

namespace Esios\Tests\Fixture;

use Esios\Tests\Fixture\EsiosTestsFixture as Fixture;
use Esios\Service\EsiosCallService;

class EsiosCallServiceMock extends EsiosCallService {

    public function getData($path, Array $params) {

        switch ($path) {
            case '/indicators/1013': return Fixture::getResponse1013();
            default:
                return null;
        }
    }

}
