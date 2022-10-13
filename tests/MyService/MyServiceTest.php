<?php

namespace MyService;

use Doubles\SingleSignOnRegistryDummy;
use Doubles\SingleSignOnRegistryFake;
use Doubles\SingleSignOnRegistryInvalidStub;
use Doubles\SingleSignOnRegistrySpy;
use Doubles\SingleSignOnRegistryValidStub;
use Exception;
use PHPUnit\Framework\TestCase;
use SSO\Request;
use SSO\SSOToken;

class MyServiceTest extends TestCase
{
    private MyService $myService;

    /**
     * @test
     **/
    public function SSOTokenWithADummyThrowsAException()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Error is valid');

        $this->myService = new MyService(new SingleSignOnRegistryDummy());

        $this->myService->handleRequest(new Request('Papirruqui', new SSOToken('token')));
    }

    /**
     * @test
     **/
    public function returnAResponseForAValidSSOToken()
    {
        $this->myService = new MyService(new SingleSignOnRegistryValidStub());

        $SSOTokenResponse = $this->myService->handleRequest(new Request('Papirruqui', new SSOToken('token')));

        $this->assertEquals('hello Papirruqui!', $SSOTokenResponse->getText());
    }

    /**
     * @test
     **/
    public function returnAResponseForAInvalidSSOToken()
    {
        $this->myService = new MyService(new SingleSignOnRegistryInvalidStub());

        $SSOTokenResponse = $this->myService->handleRequest(new Request('Papirruqui', new SSOToken('token')));

        $this->assertEquals('', $SSOTokenResponse->getText());
    }

    /**
     * @test
     **/
    public function returnNewSSOTokenWithAValidUserCredentials()
    {
        $this->myService = new MyService(new SingleSignOnRegistryFake());

        $SSOTokenResponse = $this->myService->handleRegister('papirruqui','passwd');

        $this->assertEquals(new SSOToken('papirruqui_token'), $SSOTokenResponse);
    }

    /**
     * @test
     **/
    public function returnNewSSOTokenWithAnotherValidUserCredentials()
    {
        $this->myService = new MyService(new SingleSignOnRegistryFake());

        $SSOTokenResponse = $this->myService->handleRegister('meetup','scpna');

        $this->assertEquals(new SSOToken('meetup_token'), $SSOTokenResponse);
    }

    /**
     * @test
     **/
    public function returnNullWithAInvalidUserCredentials()
    {
        $this->myService = new MyService(new SingleSignOnRegistryFake());

        $SSOTokenResponse = $this->myService->handleRegister('user','pass');

        $this->assertEmpty($SSOTokenResponse->getToken());
    }

    /**
     * @test
     **/
    public function logoutToken()
    {
        $singleSignOnSpy = new SingleSignOnRegistrySpy();

        $this->myService = new MyService($singleSignOnSpy);

        $this->myService->handleLogout(new SSOToken('tokenValid'));

        $this->assertEquals(true, $singleSignOnSpy->isDidLogout());
    }

    /**
     * @test
     **/
    public function logoutSpecificToken()
    {
        $singleSignOnSpy = new SingleSignOnRegistrySpy();

        $this->myService = new MyService($singleSignOnSpy);

        $this->myService->handleLogout(new SSOToken('tokenValid'));

        $this->assertEquals(true, $singleSignOnSpy->getLogoutToken());
    }
}
