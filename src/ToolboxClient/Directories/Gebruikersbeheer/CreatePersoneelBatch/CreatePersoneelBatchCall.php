<?php

namespace Koba\ToolboxClient\Directories\Gebruikersbeheer\CreatePersoneelBatch;

use DateTimeInterface;
use Koba\ToolboxClient\Call\AbstractCall;
use Koba\ToolboxClient\Directories\Gebruikersbeheer\GebruikersbeheerDirectory;
use Koba\ToolboxClient\Request\HttpMethod;
use Psr\Http\Message\ResponseInterface;

/**
 * @phpstan-type Leraar array{id: int, pointer: int, voornaam: string, naam: string, gebruikersnaam: string, stamnummer?: int, roepnaam?: string, geboortedatum?: DateTimeInterface, email?: string}
 */
class CreatePersoneelBatchCall extends AbstractCall
{
    /**
     * @var Leraar[] $leraren
     */
    protected array $leraren;

    /**
     * @param Leraar[] $leraren
     */
    public static function make(GebruikersbeheerDirectory $directory, array $leraren): self
    {
        return (new self($directory))->setLeraren($leraren);
    }

    /**
     * Stel de leraren die gesynchroniseer moeten worden.
     * 
     * @param Leraar[] $leraren
     */
    public function setLeraren(array $leraren): self
    {
        $this->leraren = $leraren;
        return $this;
    }

    protected function getMethod(): HttpMethod
    {
        return HttpMethod::PUT;
    }

    protected function getEndpoint(): string
    {
        return "v1/gebruikersbeheer/leraar/batch";
    }

    /**
     * @return array<mixed>
     */
    protected function getBody(): array
    {
        return $this->leraren;
    }

    public function send(): ResponseInterface
    {
        return $this->performRequest();
    }
}
