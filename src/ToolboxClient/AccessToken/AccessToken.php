<?php

namespace Koba\ToolboxClient\AccessToken;

use InvalidArgumentException;
use JsonSerializable;

class AccessToken
implements JsonSerializable
{
    protected string $accessToken;
    protected int $expires;
    protected ?string $refreshToken = null;

    /**
     * @param array<mixed> $options
     */
    public function __construct(array $options = [])
    {
        if (
            empty($options['access_token'])
            || false === is_string($options['access_token'])
        ) {
            throw new InvalidArgumentException('ongeldig access token');
        }

        $this->accessToken = $options['access_token'];

        if (
            false === empty($options['refresh_token'])
            && is_string($options['refresh_token'])
        ) {
            $this->refreshToken = $options['refresh_token'];
        }

        if (isset($options['expires_in'])) {
            if (false === is_int($options['expires_in'])) {
                throw new InvalidArgumentException('expires_in moet een integer zijn');
            }

            $this->expires = $options['expires_in'] !== 0
                ? time() + $options['expires_in']
                : 0;
        } elseif (false === empty($options['expires']) && is_int($options['expires'])) {
            $this->expires = $options['expires'];
        }
    }

    public function getToken(): string
    {
        return $this->accessToken;
    }

    public function getRefreshToken(): ?string
    {
        return $this->refreshToken;
    }

    /**
     * Checks if this token has expired.
     */
    public function hasExpired(): bool
    {
        return time() > $this->expires;
    }

    /**
     * Returns a string representation of the access token
     *
     * @return string
     */
    public function __toString()
    {
        return $this->accessToken;
    }

    /**
     * Returns an array of parameters to serialize when this is serialized with
     * json_encode().
     */
    public function jsonSerialize(): mixed
    {
        $output = [
            'access_token' => $this->accessToken,
            'expires' => $this->expires,
        ];

        if ($this->refreshToken !== null) {
            $output['refresh_token'] = $this->refreshToken;
        }

        return $output;
    }
}
