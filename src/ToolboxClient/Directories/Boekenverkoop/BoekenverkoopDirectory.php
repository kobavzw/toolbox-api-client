<?php

namespace Koba\ToolboxClient\Directories\Boekenverkoop;

use Koba\ToolboxClien\Directories\Boekenverkoop\StoreStandaardBoekhandalArtikelbestandBatch\StoreStandaardBoekhandalArtikelbestandBatchCall;
use Koba\ToolboxClient\Directory\Directory;

/**
 * @phpstan-import-type Artikel from StoreStandaardBoekhandalArtikelbestandBatchCall
 */
class BoekenverkoopDirectory extends Directory
{
    /**
     * @param Artikel[] $artikels
     */
    public function storeStandaardBoekhandelArtikelbestandBatch(
        array $artikels
    ): StoreStandaardBoekhandalArtikelbestandBatchCall {
        return StoreStandaardBoekhandalArtikelbestandBatchCall::make(
            $this,
            $artikels
        );
    }
}
