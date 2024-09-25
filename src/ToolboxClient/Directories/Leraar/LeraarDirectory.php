<?php

namespace Koba\ToolboxClient\Directories\Leraar;

use Koba\ToolboxClient\Directories\Leraar\UpdateLeraar\UpdateLeraarCall;
use Koba\ToolboxClient\Directory\Directory;

class LeraarDirectory extends Directory
{
    /**
     * Werk de gegevens van een leraar bij.
     */
    public function updateLeraar(string $pointer): UpdateLeraarCall
    {
        return UpdateLeraarCall::make($this, $pointer);
    }
}
