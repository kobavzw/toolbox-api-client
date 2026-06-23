<?php

namespace Koba\ToolboxClient\Directories\Support;

use Koba\ToolboxClient\Directories\Support\TicketMessage\TicketMessageCall;
use Koba\ToolboxClient\Directory\Directory;

class SupportDirectory extends Directory
{
    public function ticketMessage(
        string $ticketUuid,
        string $ticketTitle,
        string $createdByUserId,
        string $messageContent,
        string $posterName,
    ): TicketMessageCall {
        return TicketMessageCall::make(
            $this,
            $ticketUuid,
            $ticketTitle,
            $createdByUserId,
            $messageContent,
            $posterName,
        );
    }
}
