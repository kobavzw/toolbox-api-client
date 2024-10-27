<?php

namespace Koba\ToolboxClient\Directories\Financieel\GetOverTeZetten;

use Koba\ToolboxClient\Call\AbstractCall;
use Koba\ToolboxClient\Call\ResponseProcessor;
use Koba\ToolboxClient\Directories\Financieel\FinancieelDirectory;
use Koba\ToolboxClient\Request\HttpMethod;

class GetOverteZettenCall extends AbstractCall
{
    public static function make(FinancieelDirectory $directory): self
    {
        return new self($directory);
    }

    protected function getMethod(): HttpMethod
    {
        return HttpMethod::GET;
    }

    protected function getEndpoint(): string
    {
        return "v1/financieel/overtezetten";
    }

    public function send(): OverTeZettenResponse
    {
        return ResponseProcessor::mapClass(
            $this->performRequest(),
            OverTeZettenResponse::class
        );
    }
}
