<?php

namespace Koba\ToolboxClient\Directories\Contactpersonen\GetContactpersonen;

use Koba\ToolboxClient\Call\AbstractCall;
use Koba\ToolboxClient\Call\ResponseProcessor;
use Koba\ToolboxClient\Directory\DirectoryInterface;
use Koba\ToolboxClient\Request\HttpMethod;

class GetContactpersonenCall extends AbstractCall
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
        return 'v1/contactpersonen';
    }

    public function send(): mixed
    {
        return ResponseProcessor::mapArray(
            $this->performRequest(), 
            Instelling::class
        );
    }
}
