<?php

namespace Doubles;

use Exception;
use SSO\SingleSignOnRegistry;
use SSO\SSOToken;

class SingleSignOnRegistryFake implements SingleSignOnRegistry
{
    private $validCredentials = [
        ['Username' => 'papirruqui', 'Password' => 'passwd'],
        ['Username' => 'meetup', 'Password' => 'scpna']
    ];

    public function registerNewSession($username, $password)
    {
        foreach ($this->validCredentials as $credential) {
            if($credential['Username'] == $username && $credential['Password'] == $password)
            {
                return new SSOToken($username . '_token');
            }
        }
        return new SSOToken('');
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