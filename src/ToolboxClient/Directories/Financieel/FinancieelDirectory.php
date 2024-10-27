<?php

namespace Koba\ToolboxClient\Directories\Financieel;

use Koba\ToolboxClient\Directories\Financieel\GetOverTeZetten\GetOverteZettenCall;
use Koba\ToolboxClient\Directory\Directory;

class FinancieelDirectory extends Directory
{
    public function getOverTeZetten(): GetOverteZettenCall
    {
        return GetOverteZettenCall::make($this);
    }
}
