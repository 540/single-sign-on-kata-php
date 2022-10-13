<?php

namespace MyService;

use SSO\Request;
use SSO\Response;
use SSO\SingleSignOnRegistry;
use SSO\SSOToken;

class MyService
{
    private SingleSignOnRegistry $registry;

    public function __construct(SingleSignOnRegistry $registry)
    {
        $this->registry = $registry;
    }

    public function handleRequest(Request $request): Response
    {
        if($this->registry->isValid($request->getSSOToken())) {
            return new Response("hello ".$request->getName()."!");
        }
        return new Response('');
    }

    /**
     * @param $username
     * @param $password
     * @return SSOToken
     */
    public function handleRegister($username, $password): SSOToken
    {
        return $this->registry->registerNewSession($username, $password);
    }

    public function handleLogout(SSOToken $token)
    {
        $this->registry->unRegister($token);
    }
}
