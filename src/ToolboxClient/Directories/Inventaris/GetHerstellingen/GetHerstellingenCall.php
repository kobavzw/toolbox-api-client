<?php

namespace Koba\ToolboxClient\Directories\Inventaris\GetHerstellingen;

use Koba\ToolboxClient\Call\AbstractCall;
use Koba\ToolboxClient\Call\ResponseProcessor;
use Koba\ToolboxClient\Directories\Inventaris\Models\Herstelling;
use Koba\ToolboxClient\Directory\DirectoryInterface;
use Koba\ToolboxClient\Request\HttpMethod;

class GetHerstellingenCall extends AbstractCall
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
        return 'v1/inventaris/herstelling';
    }

    /**
     * @return Herstelling[]
     */
    public function send(): array
    {
        return ResponseProcessor::mapArray(
            $this->performRequest(),
            Herstelling::class
        );
    }
}
