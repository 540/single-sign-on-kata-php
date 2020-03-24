<?php

namespace MyService;

use PHPUnit\Framework\TestCase;
use SSO\Request;

class MyServiceTest extends TestCase
{
    /**
     * @test
     */
    public function invalidSSOTokenIsRejected()
    {
        $myService = new MyService(null);

        $response = $myService->handleRequest(new Request("Foo", null));

        $this->assertNotEquals("hello Foo!", $response->getText());
    }
}
