<?php

namespace Doubles;

use Exception;
use SSO\SingleSignOnRegistry;
use SSO\SSOToken;

class SingleSignOnRegistrySpy implements SingleSignOnRegistry
{
    private bool $didLogout;

    private string $logoutToken;

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
    public function unRegister(SSOToken $token): void
    {
        $this->didLogout = true;
        $this->logoutToken = $token->getToken();
    }

    /**
     * @return bool|null
     */
    public function isDidLogout(): ?bool
    {
        return $this->didLogout;
    }

    /**
     * @return string
     */
    public function getLogoutToken(): string
    {
        return $this->logoutToken;
    }
}