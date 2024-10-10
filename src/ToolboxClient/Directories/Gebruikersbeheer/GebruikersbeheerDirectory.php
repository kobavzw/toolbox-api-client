<?php

namespace Koba\ToolboxClient\Directories\Gebruikersbeheer;

use Koba\ToolboxClient\Directories\Gebruikersbeheer\GetPermissies\GetPermissiesCall;
use Koba\ToolboxClient\Directory\Directory;

class GebruikersbeheerDirectory extends Directory
{
    public function getPermissies(): GetPermissiesCall
    {
        return GetPermissiesCall::make($this);
    }
}
