<?php

namespace Koba\ToolboxClient\Directories\Boekenverkoop\StoreStandaardBoekhandalArtikelbestandBatch;

use DateTimeInterface;
use Koba\ToolboxClient\Call\AbstractCall;
use Koba\ToolboxClient\Directories\Boekenverkoop\BoekenverkoopDirectory;
use Koba\ToolboxClient\Request\HttpMethod;
use Psr\Http\Message\ResponseInterface;

/**
 * @phpstan-type Artikel array{
 *   isbn: string, 
 *   prijs_incl_btw: string, 
 *   uitgevercode: string,
 *   uitgevernaam: string,
 *   isbn_oud: string,
 *   titel: string,
 *   auteur: string,
 *   btwpercentage: string,
 *   meldingscode: string,
 *   melding: string,
 *   vermoedelijkeverschijningsdatum: ?DateTimeInterface,
 *   genrecode: string,
 *   genre: string,
 *   laatsteUpdate: DateTimeInterface
 * }
 */
class StoreStandaardBoekhandalArtikelbestandBatchCall extends AbstractCall
{
    /**
     * @var Artikel[] $artikels
     */
    protected array $artikels = [];

    /**
     * @param Artikel[] $artikels
     */
    public static function make(
        BoekenverkoopDirectory $directory,
        array $artikels
    ): self {
        return (new self($directory))->setArtikels($artikels);
    }

    /**
     * Stel de artikels in die in toolbox geplaatst dienen te worden.
     * 
     * @param Artikel[] $artikels
     */
    public function setArtikels(array $artikels = []): self
    {
        $this->artikels = $artikels;
        return $this;
    }

    protected function getMethod(): HttpMethod
    {
        return HttpMethod::POST;
    }

    protected function getEndpoint(): string
    {
        return 'boekenverkoop/standaard_boekhandel/artikelbestand/batch';
    }

    /**
     * @return array<array-key,mixed>
     */
    protected function getBody(): array
    {
        return array_map(
            fn ($entry) => [
                ...$entry,
                'vermoedelijkeverschijningsdatum' => $entry['vermoedelijkeverschijningsdatum']?->format('c'),
                'laatsteUpdate' => $entry['laatsteUpdate']->format('c'),
            ],
            $this->artikels
        );
    }

    public function send(): ResponseInterface
    {
        return $this->performRequest();
    }
}
