<?php

namespace Koba\ToolboxClient\Directories\Statistieken;

use Koba\ToolboxClient\Directories\Statistieken\GetStatistieken\GetStatistiekenCall;
use Koba\ToolboxClient\Directory\Directory;

class StatistiekenDirectory extends Directory
{
    public function get(): GetStatistiekenCall
    {
        return GetStatistiekenCall::make($this);
    }
}