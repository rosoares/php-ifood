<?php


class TokenAuthentication
{

    public function authenticate()
    {
        // TODO autenticar e retornar o token
    }

    /**
     * @var string
     */
    private $cliendID;

    /**
     * @return string
     */
    public function getCliendID(): string
    {
        return $this->cliendID;
    }

    /**
     * @param string $cliendID
     */
    public function setCliendID(string $cliendID): void
    {
        $this->cliendID = $cliendID;
    }

    /**
     * @return string
     */
    public function getClientSecret(): string
    {
        return $this->clientSecret;
    }

    /**
     * @param string $clientSecret
     */
    public function setClientSecret(string $clientSecret): void
    {
        $this->clientSecret = $clientSecret;
    }

    /**
     * @var string
     */
    private $clientSecret;


}