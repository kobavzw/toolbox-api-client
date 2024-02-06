<?php

namespace Koba\ToolboxClient\AccessToken;

use Koba\ToolboxClient\Exception\AccessTokenException;
use Koba\ToolboxClient\Scopes\ScopeStrategyInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

class ClientCredentialsStrategy
implements AccessTokenStrategyInterface, RequiresHttpFactoriesInterface
{
    protected string $toolboxUrl;
    protected ?AccessToken $accessToken = null;

    protected ClientInterface $httpClient;
    protected RequestFactoryInterface $requestFactory;
    protected StreamFactoryInterface $streamFactory;

    public function __construct(
        protected int $clientId,
        protected string $clientSecret,
        protected ScopeStrategyInterface $scopeStrategy
    ) {
    }

    public function setFactories(
        ClientInterface $httpClient,
        RequestFactoryInterface $requestFactory,
        StreamFactoryInterface $streamFactory
    ): self {
        $this->httpClient = $httpClient;
        $this->requestFactory = $requestFactory;
        $this->streamFactory = $streamFactory;
        return $this;
    }

    public function setScopeStrategy(ScopeStrategyInterface $scopeStrategy): self
    {
        $this->scopeStrategy = $scopeStrategy;
        return $this;
    }

    /**
     * Returns an access token.
     * Will return the internally stored access token or fetch a new one.
     */
    public function getAccessToken(): AccessToken
    {
        if ($this->accessToken === null || $this->accessToken->hasExpired()) {
            $this->accessToken = $this->fetchAccessToken();
        }

        return $this->accessToken;
    }

    /**
     * Fetches a new access token and returns it.
     */
    protected function fetchAccessToken(): AccessToken
    {
        $request = $this->requestFactory
            ->createRequest(
                'POST',
                "{$this->toolboxUrl}/oauth/token"
            )
            ->withAddedHeader('Content-Type', 'application/x-www-form-urlencoded')
            ->withBody($this->streamFactory->createStream(
                http_build_query([
                    'client_id' => $this->clientId,
                    'client_secret' => $this->clientSecret,
                    'scope' => (string)$this->scopeStrategy,
                    'grant_type' => 'client_credentials'
                ])
            ));

        $response = $this->httpClient->sendRequest($request);
        if ($response->getStatusCode() !== 200) {
            throw new AccessTokenException('Fetching access token failed.');
        }

        /** @var array<mixed> $decoded */
        $decoded = json_decode(
            $response->getBody()->getContents(),
            true
        );

        return new AccessToken($decoded);
    }

    /**
     * Sets the base URL of the toolbox.
     */
    public function setToolboxUrl(string $url): self
    {
        $this->toolboxUrl = rtrim($url, '/');
        return $this;
    }
}
