<?php

namespace Koba\ToolboxClient\Request;

use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Koba\ToolboxClient\AccessToken\AccessTokenStrategyInterface;
use Koba\ToolboxClient\AccessToken\RequiresHttpFactoriesInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

class EncapsulatedRequestFactory
{
    protected string $toolboxUrl;
    protected ClientInterface $httpClient;
    protected RequestFactoryInterface $requestFactory;
    protected StreamFactoryInterface $streamFactory;

    public function __construct(
        string $toolboxUrl,
        protected AccessTokenStrategyInterface $accessTokenStrategy,
        ?ClientInterface $httpClient,
        ?RequestFactoryInterface $requestFactory,
        ?StreamFactoryInterface $streamFactory,
    ) {
        $this->httpClient = $httpClient
            ?? Psr18ClientDiscovery::find();
        $this->requestFactory = $requestFactory
            ?? Psr17FactoryDiscovery::findRequestFactory();
        $this->streamFactory = $streamFactory
            ?? Psr17FactoryDiscovery::findStreamFactory();

        $toolboxUrl = rtrim($toolboxUrl, '/');
        $this->toolboxUrl = $toolboxUrl;
        $accessTokenStrategy->setToolboxUrl($toolboxUrl);
        if ($accessTokenStrategy instanceof RequiresHttpFactoriesInterface) {
            $accessTokenStrategy->setFactories(
                $this->httpClient,
                $this->requestFactory,
                $this->streamFactory
            );
        }
    }

    public function make(string $endpoint, HttpMethod $method): EncapsulatedRequest
    {
        return new EncapsulatedRequest(
            $this->requestFactory
                ->createRequest($method->value, $this->toolboxUrl . '/api/' . ltrim($endpoint))
                ->withAddedHeader(
                    'Authorization',
                    'Bearer ' . $this->accessTokenStrategy->getAccessToken()->getToken()
                )
                ->withAddedHeader('Content-Type', 'application/json')
                ->withAddedHeader('Accept', 'application/json'),
            $this->httpClient,
            $this->streamFactory
        );
    }
}
