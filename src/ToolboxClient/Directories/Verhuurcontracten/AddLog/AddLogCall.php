<?php

namespace Koba\ToolboxClient\Directories\Verhuurcontracten\AddLog;

use Koba\ToolboxClient\Call\AbstractCall;
use Koba\ToolboxClient\Directories\Verhuurcontracten\VerhuurcontractenDirectory;
use Koba\ToolboxClient\Request\HttpMethod;
use Psr\Http\Message\ResponseInterface;

class AddLogCall extends AbstractCall
{
    protected int $contractId;
    protected int $status;
    protected ?string $statusOmschrijving = null;

    public function setContractId(int $contractId): self
    {
        $this->contractId = $contractId;
        return $this;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function setStatusOmschrijving(?string $omschrijving): self
    {
        $this->statusOmschrijving = $omschrijving;
        return $this;
    }

    public static function make(
        VerhuurcontractenDirectory $directory,
        int $contractId,
        int $status,
    ): self {
        return (new self($directory))
            ->setContractId($contractId)
            ->setStatus($status);
    }

    protected function getMethod(): HttpMethod
    {
        return HttpMethod::PUT;
    }

    protected function getEndpoint(): string
    {
        return "v1/verhuurcontrantacten/contract/{$this->contractId}/log";
    }

    /**
     * @return array<string,mixed>
     */
    protected function getBody(): array
    {
        return [
            'status' => $this->status,
            'status_omschrijving' => $this->statusOmschrijving,
        ];
    }

    public function send(): ResponseInterface
    {
        return $this->performRequest();
    }
}
