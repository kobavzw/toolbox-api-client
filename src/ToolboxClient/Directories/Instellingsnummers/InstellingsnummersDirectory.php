<?php

namespace Koba\ToolboxClient\Directories\Instellingsnummers;

use Koba\ToolboxClient\Directories\Instellingsnummers\GetInstellingsnummers\GetInstellingsnummersCall;
use Koba\ToolboxClient\Directory\Directory;

class InstellingsnummersDirectory extends Directory
{
    public function get(): GetInstellingsnummersCall
    {
        return GetInstellingsnummersCall::make($this);
    }
}
