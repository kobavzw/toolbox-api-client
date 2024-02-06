<?php

namespace Koba\ToolboxClient\Request;

use Koba\ToolboxClient\Exception\InternalErrorException;
use Koba\ToolboxClient\Exception\RequestException;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;

class EncapsulatedRequest
{
    public function __construct(
        protected RequestInterface $request,
        protected ClientInterface $httpClient,
        protected StreamFactoryInterface $streamFactory
    ) {
    }

    /**
     * @param array<mixed>|string $body
     */
    public function withBody(array|string $body): self
    {
        if (is_array($body)) {
            $body = json_encode($body);
        }

        if ($body === false) {
            throw new InternalErrorException('Invalid call content.');
        }

        $this->request = $this->request->withBody(
            $this->streamFactory->createStream($body)
        );

        return $this;
    }

    public function send(): ResponseInterface
    {
        $response = $this->httpClient->sendRequest($this->request);

        if ($response->getStatusCode() === 200) {
            return $response;
        } else {
            throw new RequestException($response->getBody()->getContents());
        }
    }
}
