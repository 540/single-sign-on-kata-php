<?php

namespace Doubles;

use Exception;
use SSO\SingleSignOnRegistry;
use SSO\SSOToken;

class SingleSignOnRegistryDummy implements SingleSignOnRegistry
{
    /**
     * @throws Exception
     */
    public function registerNewSession($username, $password)
    {
        throw new Exception('Error registering new session');
    }

    /**
     * @throws Exception
     */
    public function isValid(SSOToken $token): bool
    {
        throw new Exception('Error is valid');
    }

    /**
     * @throws Exception
     */
    public function unRegister(SSOToken $token)
    {
        throw new Exception('Error login out');
    }
}