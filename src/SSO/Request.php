<?php

namespace SSO;

class Request
{
    private string $name;

    private SSOToken $token;

    /**
     * Request constructor.
     * @param $name
     * @param SSOToken|null $token
     */
    public function __construct($name, ?SSOToken $token)
    {
        $this->name = $name;
        $this->token = $token;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return SSOToken
     */
    public function getToken()
    {
        return $this->token;
    }
}
