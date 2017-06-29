<?php

namespace MyService;

use SSO\Request;

class MyServiceTest extends \PHPUnit_Framework_TestCase
{
    public function testInvalidSSOTokenIsRejected()
    {
        $myService = new MyService(null);
        $response = $myService->handleRequest(new Request("Papirruqui", null));
        $this->assertNotEquals("hello Papirruqui!", $response->getText());
    }
}
