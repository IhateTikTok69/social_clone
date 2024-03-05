<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PusherBroadcast implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $message;
    public $convoId;
    public $sendDate;
    public $senderPic;
    public $senderId;
    public $senderName;

    public function __construct(string $message, $convoId, $senderName, $senderPic, $sendDate, $senderId)
    {
        $this->message = $message;
        $this->convoId = $convoId;
        $this->senderName = $senderName;
        $this->senderPic = $senderPic;
        $this->sendDate = $sendDate;
        $this->senderId = $senderId;
    }
    public function broadcastOn(): array
    {
        return [$this->convoId];
    }

    public function broadcastAs(): string
    {
        return 'chat';
    }
}
