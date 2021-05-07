<?php

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class GuzzleHttpClientAdapter implements HttpClientInterface
{
    /**
     * @var Client
     */
    public $client;

    /**
     * @var array
     */
    public $headers;

    /**
     * GuzzleHttpClientAdapter constructor.
     * @param string $baseUri
     * @param float $timeout
     */
    public function __construct(string $baseUri, float $timeout = 2.0)
    {
        $this->client = new Client([
            'base_uri' => $baseUri,
            'timeout' => $timeout,
        ]);
    }

    /**
     * @param array $data
     * @return $this
     */
    public function setHeaders(array $data): GuzzleHttpClientAdapter
    {
        $this->headers = $data;

        return $this;
    }

    /**
     * @param string $uri
     * @param array $data
     * @return GuzzleHttpResponseAdapter
     */
    public function post(string $uri, array $data)
    {
        try {
            $response = $this->client->post($uri, [
                'headers' => $this->headers,
                'body' => $data
            ]);

            return $this->getHttpResponse($response);

        } catch (GuzzleException $e) {
            return $this->getHttpResponseByException($e);
        }
    }

    /**
     * @param string $uri
     * @param array|null $params
     * @return GuzzleHttpResponseAdapter
     */
    public function get(string $uri, array $params = null)
    {
        try {
            $response = $this->client->get($uri, [
                'headers' => $this->headers,
                'form_params' => $params
            ]);

            return $this->getHttpResponse($response);

        } catch (GuzzleException $e) {
            return $this->getHttpResponseByException($e);
        }
    }

    /**
     * @param ResponseInterface $response
     * @return GuzzleHttpResponseAdapter
     */
    private function getHttpResponse(ResponseInterface $response)
    {
        $httpResponse = new GuzzleHttpResponseAdapter();

        return $httpResponse->parseResponse($response);
    }

    /**
     * @param GuzzleException $exception
     * @return GuzzleHttpResponseAdapter
     */
    private function getHttpResponseByException(GuzzleException $exception)
    {
        $httpResponse = new GuzzleHttpResponseAdapter();
        $httpResponse->setResponseBody($exception->getMessage());
        $httpResponse->setStatusCode($exception->getCode());

        return $httpResponse;
    }

    public function getClient()
    {
        return $this->client;
    }

    public function setClient($client)
    {
        $this->client = $client;
    }
}