<?php

namespace Koba\ToolboxClient\Directories\Leerling;

use Koba\ToolboxClient\Directories\Leerling\UpdateLeerling\UpdateLeerlingCall;
use Koba\ToolboxClient\Directory\Directory;

class LeerlingDirectory extends Directory
{
    /**
     * Werk de gegevens van een leerling bij.
     */
    public function updateLeerling(string $pointer): UpdateLeerlingCall
    {
        return UpdateLeerlingCall::make($this, $pointer);
    }
}
