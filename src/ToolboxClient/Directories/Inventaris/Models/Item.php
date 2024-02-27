<?php

namespace Koba\ToolboxClient\Directories\Inventaris\Models;

use DateTime;

class Item
{
    public int $id;

    public string $serienummer;

    public ?DateTime $factuurdatum;

    public string $type;

    public string $subtype;

    public string $merk;

    public string $model;

    public ?Leverancier $leverancier;
}