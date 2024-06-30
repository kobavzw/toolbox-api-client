<?php

namespace Koba\ToolboxClient\Directories\Verhuurcontracten;

use Koba\ToolboxClient\Directories\Verhuurcontracten\AddLog\AddLogCall;
use Koba\ToolboxClient\Directory\Directory;

class VerhuurcontractenDirectory extends Directory
{
    public function addLog(int $contractId, int $status): AddLogCall
    {
        return AddLogCall::make($this, $contractId, $status);
    }
}
