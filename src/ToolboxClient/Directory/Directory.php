<?php

namespace Koba\ToolboxClient\Directory;

use Koba\ToolboxClient\Request\EncapsulatedRequestFactory;

class Directory implements DirectoryInterface
{
    public function __construct(protected EncapsulatedRequestFactory $requestFactory)
    {
    }

    public function getRequestFactory(): EncapsulatedRequestFactory
    {
        return $this->requestFactory;
    }
}
