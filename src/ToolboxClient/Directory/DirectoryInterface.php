<?php

namespace Koba\ToolboxClient\Directory;

use Koba\ToolboxClient\Request\EncapsulatedRequestFactory;

interface DirectoryInterface
{
    public function getRequestFactory(): EncapsulatedRequestFactory;
}