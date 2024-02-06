<?php

namespace Koba\ToolboxClient\Call;

use Koba\ToolboxClient\Directory\DirectoryInterface;
use Koba\ToolboxClient\Request\HttpMethod;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractCall
{
    protected function __construct(protected DirectoryInterface $directory)
    {
    }

    abstract protected function getMethod(): HttpMethod;
    abstract protected function getEndpoint(): string;
    abstract public function send(): mixed;

    /**
     * @return null|string|array<mixed>
     */
    protected function getBody(): null|string|array
    {
        return null;
    }

    protected function performRequest(): ResponseInterface
    {
        $request = $this->directory->getRequestFactory()->make(
            $this->getEndpoint(),
            $this->getMethod(),
        );

        if ($this->getBody() !== null) {
            $request->withBody($this->getBody());
        }

        return $request->send();
    }
}
