<?php

namespace Koba\ToolboxClient;

use Koba\ToolboxClient\AccessToken\AccessTokenStrategyInterface;
use Koba\ToolboxClient\Directories\Contactpersonen\ContactpersonenDirectory;
use Koba\ToolboxClient\Directories\Financieel\FinancieelDirectory;
use Koba\ToolboxClient\Directories\Gebruikersbeheer\GebruikersbeheerDirectory;
use Koba\ToolboxClient\Directories\Instellingsnummers\InstellingsnummersDirectory;
use Koba\ToolboxClient\Directories\Inventaris\InventarisDirectory;
use Koba\ToolboxClient\Directories\Leerling\LeerlingDirectory;
use Koba\ToolboxClient\Directories\Leraar\LeraarDirectory;
use Koba\ToolboxClient\Directories\Statistieken\StatistiekenDirectory;
use Koba\ToolboxClient\Directories\Verhuurcontracten\VerhuurcontractenDirectory;
use Koba\ToolboxClient\Request\EncapsulatedRequestFactory;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

class ToolboxClient
{
    protected EncapsulatedRequestFactory $requestFactory;

    public function __construct(
        string $toolboxUrl,
        protected AccessTokenStrategyInterface $accessTokenStrategy,
        ?ClientInterface $httpClient = null,
        ?RequestFactoryInterface $requestFactory = null,
        ?StreamFactoryInterface $streamFactory = null,
    ) {
        $this->requestFactory = new EncapsulatedRequestFactory(
            $toolboxUrl,
            $accessTokenStrategy,
            $httpClient,
            $requestFactory,
            $streamFactory,
        );
    }

    public function statistieken(): StatistiekenDirectory
    {
        return new StatistiekenDirectory($this->requestFactory);
    }

    public function contactpersonen(): ContactpersonenDirectory
    {
        return new ContactpersonenDirectory($this->requestFactory);
    }

    public function instellingsnummers(): InstellingsnummersDirectory
    {
        return new InstellingsnummersDirectory($this->requestFactory);
    }

    public function inventaris(): InventarisDirectory
    {
        return new InventarisDirectory($this->requestFactory);
    }

    public function verhuurcontracten(): VerhuurcontractenDirectory
    {
        return new VerhuurcontractenDirectory($this->requestFactory);
    }

    public function leerlingen(): LeerlingDirectory
    {
        return new LeerlingDirectory($this->requestFactory);
    }

    public function leraren(): LeraarDirectory
    {
        return new LeraarDirectory($this->requestFactory);
    }

    public function gebruikersbeheer(): GebruikersbeheerDirectory
    {
        return new GebruikersbeheerDirectory($this->requestFactory);
    }

    public function financieel(): FinancieelDirectory
    {
        return new FinancieelDirectory($this->requestFactory);
    }
}
