<?php


interface HttpClientInterface
{
    public function setHeaders(array $data);

    public function post(string $uri, array $data);

    public function get(string $uri, array $params = null);

    public function getClient();

    public function setClient($client);
}