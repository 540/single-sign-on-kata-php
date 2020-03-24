<?php

namespace MyService;

use SSO\Request;
use SSO\Response;
use SSO\SingleSignOnRegistry;

class MyService
{
    /**
     * @var SingleSignOnRegistry
     */
    private $registry;

    /**
     * @param SingleSignOnRegistry $registry
     */
    public function __construct(?SingleSignOnRegistry $registry)
    {
        $this->registry = $registry;
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function handleRequest(Request $request)
    {
        return new Response("hello ".$request->getName()."!");
    }
	
    /**
     * @param string $username
     * @param string $password
     *
     * @return SSOToken
     */
    public function handleRegister($username, $password)
    {
        return;
    }
	
    /**
     * @param SSOToken
     */
    public function handleUnRegister(SSOToken $token)
    {
        return;
    }
}
