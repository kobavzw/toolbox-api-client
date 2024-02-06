<?php

namespace Koba\ToolboxClient;

use Koba\ToolboxClient\AccessToken\AccessTokenStrategyInterface;
use Koba\ToolboxClient\Directories\Statistieken\StatistiekenDirectory;
use Koba\ToolboxClient\Request\EncapsulatedRequestFactory;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

class ToolboxClient
{
    protected EncapsulatedRequestFactory $requestFactory;

    public function __construct(
        string $toolboxUrl,
        protected AccessTokenStrategyInterface $accessTokenStrategy,
        ?ClientInterface $httpClient = null,
        ?RequestFactoryInterface $requestFactory = null,
        ?StreamFactoryInterface $streamFactory = null,
    ) {
        $this->requestFactory = new EncapsulatedRequestFactory(
            $toolboxUrl,
            $accessTokenStrategy,
            $httpClient,
            $requestFactory,
            $streamFactory,
        );
    }

    public function statistieken(): StatistiekenDirectory
    {
        return new StatistiekenDirectory($this->requestFactory);
    }
}
