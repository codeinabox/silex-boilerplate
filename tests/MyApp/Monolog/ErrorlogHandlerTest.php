<?php

namespace tests\MyApp\Monolog;

use Monolog\Logger;
use MyApp\Monolog\ErrorlogHandler;

class ErrorlogHandlerrTest extends \PHPUnit_Framework_TestCase
{

    public function test_ShouldConstruct()
    {
        $handler = new ErrorlogHandler();
        $this->assertInstanceOf('MyApp\Monolog\ErrorlogHandler', $handler);

        $handler = new ErrorlogHandler(Logger::DEBUG, true, LOG_PERROR);
        $this->assertInstanceOf('MyApp\Monolog\ErrorlogHandler', $handler);
    }


}
