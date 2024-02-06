<?php

namespace Koba\ToolboxClient\Directories\Statistieken\GetStatistieken;

use Koba\ToolboxClient\Call\AbstractCall;
use Koba\ToolboxClient\Call\ResponseProcessor;
use Koba\ToolboxClient\Directory\DirectoryInterface;
use Koba\ToolboxClient\Request\HttpMethod;

class GetStatistiekenCall extends AbstractCall
{
    public static function make(DirectoryInterface $directory): self
    {
        return new self($directory);
    }

    protected function getMethod(): HttpMethod
    {
        return HttpMethod::GET;
    }

    protected function getEndpoint(): string
    {
        return 'v1/statistieken';
    }

    /**
     * @return array<string,int>
     */
    public function send(): array
    {
        /** @var array<string,int> $response */
        $response = ResponseProcessor::processDataAttribute(
            $this->performRequest()
        );

        return $response;
    }
}
