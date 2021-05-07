<?php


use Psr\Http\Message\ResponseInterface;

class GuzzleHttpResponseAdapter implements HttpResponse
{
    /**
     * @var stdClass
     */
    public $response;

    /**
     * @var int
     */
    public $statusCode;

    /**
     * @var stdClass
     */
    public $headers;

    /**
     * @return stdClass
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @return stdClass
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param array $response
     */
    public function setResponseBody(string $response)
    {
        $this->response = json_decode($response);
    }

    /**
     * @param int $statusCode
     */
    public function setStatusCode(int $statusCode)
    {
        $this->statusCode = $statusCode;
    }

    /**
     * @param array $headers
     */
    public function setHeaders(array $headers)
    {
        $this->headers = (object) $headers;
    }

    /**
     * @param ResponseInterface
     */
    public function parseResponse($response)
    {
        $this->parseGuzzleResponse($response);

        return $this;
    }

    /**
     * @param ResponseInterface $response
     */
    private function parseGuzzleResponse(ResponseInterface $response)
    {
        $this->setResponseBody($response->getBody()->getContents());
        $this->setHeaders($response->getHeaders());
        $this->setStatusCode($response->getStatusCode());
    }
}