<?php

namespace Koba\ToolboxClient\AccessToken;

interface AccessTokenStrategyInterface
{
    public function getAccessToken(): AccessToken;
    public function setToolboxUrl(string $url): self;
}
