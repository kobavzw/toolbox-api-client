<?php

namespace Koba\ToolboxClient\Call;

use JsonMapper\JsonMapperFactory;
use JsonMapper\JsonMapperInterface;
use Koba\ToolboxClient\Exception\InternalErrorException;
use Psr\Http\Message\ResponseInterface;

class ResponseProcessor
{
    protected static function getJsonMapper(): JsonMapperInterface
    {
        return (new JsonMapperFactory())->bestFit();
    }

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

    /**
     * @template T of object
     * @param class-string<T> $targetClass
     * @return T[]
     */
    public static function mapArray(ResponseInterface $response, string $targetClass)
    {
        $decoded = json_decode($response->getBody()->getContents());
        if (is_object($decoded) && property_exists($decoded, 'data')) {
            return self::getJsonMapper()->mapToClassArray(
                $decoded->data,
                $targetClass
            );
        }

        throw new InternalErrorException('Invalid JSON property requested.');
    }
}
