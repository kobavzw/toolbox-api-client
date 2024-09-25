<?php

namespace Koba\ToolboxClient\Directories\Leraar\UpdateLeraar;

use Koba\ToolboxClient\Call\AbstractCall;
use Koba\ToolboxClient\Call\ResponseProcessor;
use Koba\ToolboxClient\Directories\Leraar\LeraarDirectory;
use Koba\ToolboxClient\Directories\Leraar\Models\Leraar;
use Koba\ToolboxClient\Request\HttpMethod;

class UpdateLeraarCall
extends AbstractCall
{
    protected string $pointer;

    /**
     * @var array<string,mixed> $body
     */
    protected array $body = [];

    /**
     * Maak een nieuwe call aan.
     */
    public static function make(
        LeraarDirectory $directory,
        string $pointer
    ): self {
        return (new self($directory))->setPointer($pointer);
    }

    /**
     * De pointer van de leraar waarvan je de gegevens wil updaten.
     */
    protected function setPointer(string $pointer): self
    {
        $this->pointer = $pointer;
        return $this;
    }

    /**
     * Stel het betaalkaart nummer van de leraar in.
     */
    public function setBetaalkaartNummer(string $nummer): self
    {
        $this->body['betaalkaart_nummer'] = $nummer;
        return $this;
    }


    protected function getMethod(): HttpMethod
    {
        return HttpMethod::PUT;
    }

    protected function getEndpoint(): string
    {
        return "v1/gebruiker/leraar/{$this->pointer}";
    }

    /**
     * @return array<string,mixed>
     */
    protected function getBody(): array
    {
        return $this->body;
    }

    /**
     * Voer de request uit
     */
    public function send(): Leraar
    {
        return ResponseProcessor::mapClass(
            $this->performRequest(),
            Leraar::class
        );
    }
}
