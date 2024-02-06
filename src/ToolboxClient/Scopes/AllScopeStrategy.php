<?php

namespace Koba\ToolboxClient\Scopes;

class AllScopeStrategy implements ScopeStrategyInterface
{
    public function __toString(): string
    {
        return '*';
    }
}