<?php


interface HttpResponse
{
    public function getResponse();

    public function getStatusCode();

    public function getHeaders();

    public function setResponseBody(string $response);

    public function setStatusCode(int $statusCode);

    public function setHeaders(array $headers);

    public function parseResponse($response);
}