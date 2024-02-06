<?php

namespace Koba\ToolboxClient\Scopes;

class SpecificScopesStrategy implements ScopeStrategyInterface
{
    /**
     * @param Scope[] $scopes
     */
    public function __construct(protected array $scopes)
    {
    }

    public function __toString(): string
    {
        return implode(' ', array_map(
            fn (Scope $scope) => $scope->value,
            $this->scopes
        ));
    }
}
