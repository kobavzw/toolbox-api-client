<?php

namespace Koba\ToolboxClient\Directories\Gebruikersbeheer\GetPermissies;

use Koba\ToolboxClient\Call\AbstractCall;
use Koba\ToolboxClient\Call\ResponseProcessor;
use Koba\ToolboxClient\Directories\Gebruikersbeheer\GebruikersbeheerDirectory;
use Koba\ToolboxClient\Directories\Gebruikersbeheer\Models\Permissie;
use Koba\ToolboxClient\Request\HttpMethod;

class GetPermissiesCall extends AbstractCall
{
    public static function make(GebruikersbeheerDirectory $directory): self
    {
        return new self($directory);
    }

    protected function getMethod(): HttpMethod
    {
        return HttpMethod::GET;
    }

    protected function getEndpoint(): string
    {
        return "v1/gebruikersbeheer/permissie";
    }

    /**
     * @return Permissie[]
     */
    public function send(): array
    {
        return ResponseProcessor::mapArray(
            $this->performRequest(),
            Permissie::class
        );
    }
}
