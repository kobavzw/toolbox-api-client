<?php

namespace Koba\ToolboxClient\Directories\Inventaris;

use Koba\ToolboxClient\Directories\Inventaris\GetHerstellingen\GetHerstellingenCall;
use Koba\ToolboxClient\Directory\Directory as DirectoryDirectory;

class InventarisDirectory extends DirectoryDirectory
{
    public function getHerstellingen(): GetHerstellingenCall
    {
        return GetHerstellingenCall::make($this);
    }
}
