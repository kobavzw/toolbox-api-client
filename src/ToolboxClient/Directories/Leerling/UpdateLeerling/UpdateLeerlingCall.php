<?php

namespace Koba\ToolboxClient\Directories\Leerling\UpdateLeerling;

use Koba\ToolboxClient\Call\AbstractCall;
use Koba\ToolboxClient\Call\ResponseProcessor;
use Koba\ToolboxClient\Directories\Leerling\LeerlingDirectory;
use Koba\ToolboxClient\Directories\Leerling\Models\Leerling;
use Koba\ToolboxClient\Request\HttpMethod;

class UpdateLeerlingCall
extends AbstractCall
{
    public string $pointer;

    /**
     * @var array<string,mixed> $body
     */
    protected array $body = [];

    /**
     * Maak een nieuwe call aan.
     */
    public static function make(
        LeerlingDirectory $directory,
        string $pointer
    ): self {
        return (new self($directory))->setPointer($pointer);
    }

    /**
     * De pointer van de leerling waarvan je de gegevens wil updaten.
     */
    protected function setPointer(string $pointer): self
    {
        $this->pointer = $pointer;
        return $this;
    }

    /**
     * Stel het betaalkaart nummer van de leerling in.
     */
    public function setBetaalkaartNummer(?string $nummer): self
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
        return "v1/gebruiker/leerling/{$this->pointer}";
    }

    /**
     * @return array<string,mixed>
     */
    protected function getBody(): array
    {
        return $this->body;
    }

    /**
     * Voer de request uit.
     */
    public function send(): Leerling
    {
        return ResponseProcessor::mapClass(
            $this->performRequest(),
            Leerling::class
        );
    }
}
