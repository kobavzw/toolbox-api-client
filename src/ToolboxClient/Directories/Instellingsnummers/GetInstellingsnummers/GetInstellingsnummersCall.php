<?php

namespace Koba\ToolboxClient\Directories\Instellingsnummers\GetInstellingsnummers;

use Koba\ToolboxClient\Call\AbstractCall;
use Koba\ToolboxClient\Call\ResponseProcessor;
use Koba\ToolboxClient\Directory\DirectoryInterface;
use Koba\ToolboxClient\Request\HttpMethod;

class GetInstellingsnummersCall
extends AbstractCall
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
        return 'v1/instellingsnummers';
    }

    /** @return Instellingsnummer[] */
    public function send(): array
    {
        return ResponseProcessor::mapArray(
            $this->performRequest(),
            Instellingsnummer::class
        );
    }
}
