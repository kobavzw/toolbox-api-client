<?php

namespace Koba\ToolboxClient\Directories\Gebruikersbeheer;

use Koba\ToolboxClient\Directories\Gebruikersbeheer\CreatePersoneelBatch\CreatePersoneelBatchCall;
use Koba\ToolboxClient\Directories\Gebruikersbeheer\GetPermissies\GetPermissiesCall;
use Koba\ToolboxClient\Directory\Directory;

/**
 * @phpstan-import-type Leraar from CreatePersoneelBatchCall as BatchLeraar
 */
class GebruikersbeheerDirectory extends Directory
{
    public function getPermissies(): GetPermissiesCall
    {
        return GetPermissiesCall::make($this);
    }

    /**
     * Maak personeelsleden in batch aan.
     * 
     * @param BatchLeraar[] $leraren
     */
    public function createPersoneelBatch(array $leraren): CreatePersoneelBatchCall
    {
        return CreatePersoneelBatchCall::make($this, $leraren);
    }
}
