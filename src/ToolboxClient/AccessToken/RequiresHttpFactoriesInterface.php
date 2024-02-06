<?php

namespace Koba\ToolboxClient\AccessToken;

use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

interface RequiresHttpFactoriesInterface
{
    public function setFactories(
        ClientInterface $httpClient,
        RequestFactoryInterface $requestFactory,
        StreamFactoryInterface $streamFactory,
    ): self;
}
