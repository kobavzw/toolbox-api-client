<?php

namespace Koba\ToolboxClient\Directories\Support\TicketMessage;

use Koba\ToolboxClient\Call\AbstractCall;
use Koba\ToolboxClient\Directories\Support\SupportDirectory;
use Koba\ToolboxClient\Request\HttpMethod;
use Psr\Http\Message\ResponseInterface;

class TicketMessageCall extends AbstractCall
{
    protected string $ticketUuid;
    protected string $ticketTitle;
    protected string $createdByUserId;
    protected string $messageContent;
    protected string $posterName;

    public static function make(
        SupportDirectory $directory,
        string $ticketUuid,
        string $ticketTitle,
        string $createdByUserId,
        string $messageContent,
        string $posterName,
    ): self {
        $call = new self($directory);
        $call->ticketUuid = $ticketUuid;
        $call->ticketTitle = $ticketTitle;
        $call->createdByUserId = $createdByUserId;
        $call->messageContent = $messageContent;
        $call->posterName = $posterName;

        return $call;
    }

    protected function getMethod(): HttpMethod
    {
        return HttpMethod::POST;
    }

    protected function getEndpoint(): string
    {
        return 'webhooks/support/ticket-message';
    }

    /**
     * @return array{
     *   ticket: array{
     *     uuid: string,
     *     title: string,
     *     created_by: array{user_id: string}
     *   },
     *   message: array{
     *     content: string,
     *     poster: array{name: string}
     *   }
     * }
     */
    protected function getBody(): array
    {
        return [
            'ticket' => [
                'uuid' => $this->ticketUuid,
                'title' => $this->ticketTitle,
                'created_by' => [
                    'user_id' => $this->createdByUserId,
                ],
            ],
            'message' => [
                'content' => $this->messageContent,
                'poster' => [
                    'name' => $this->posterName,
                ],
            ],
        ];
    }

    public function send(): ResponseInterface
    {
        return $this->performRequest();
    }
}
