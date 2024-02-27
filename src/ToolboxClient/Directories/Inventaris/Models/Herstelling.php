<?php

namespace Koba\ToolboxClient\Directories\Inventaris\Models;

use DateTime;

class Herstelling
{
    public int $id;

    public ?DateTime $datum_aangemeld_extern;

    public ?DateTime $datum_hersteld_extern;

    public string $herstellocatie;

    public string $onderdeel;

    public ?Item $item;
}