<?php

namespace Koba\ToolboxClient\Directories\Contactpersonen;

use Koba\ToolboxClient\Directories\Contactpersonen\GetContactpersonen\GetContactpersonenCall;
use Koba\ToolboxClient\Directory\Directory;

class ContactpersonenDirectory extends Directory
{
    public function get(): GetContactpersonenCall
    {
        return GetContactpersonenCall::make($this);
    }
}
