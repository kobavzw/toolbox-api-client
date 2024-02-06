<?php

namespace Koba\ToolboxClient\Call;

use Koba\ToolboxClient\Exception\InternalErrorException;
use Psr\Http\Message\ResponseInterface;

class ResponseProcessor
{
    /**
     * @return array<mixed>
     */
    public static function processJson(ResponseInterface $response): array
    {
        $decoded = json_decode($response->getBody()->getContents(), true);
        if (false === is_array($decoded)) {
            throw new InternalErrorException('Ongeldige response');
        }

        return $decoded;
    }

    /**
     * @return array<mixed>
     */
    public static function processDataAttribute(ResponseInterface $response): array
    {
        $decoded = self::processJson($response);
        if (empty($decoded['data']) || false === is_array($decoded['data'])) {
            throw new InternalErrorException('Ongeldige response');
        }
        return $decoded['data'];
    }
}