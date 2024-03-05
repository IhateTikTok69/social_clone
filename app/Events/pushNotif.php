<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class pushNotif implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $senderId;
    public $senderName;
    public $senderPic;
    public $convoId;
    public $targetId;
    public function __construct($senderId, $senderName, $senderPic, $convoId, $targetId)
    {
        $this->convoId = $convoId;
        $this->senderId = $senderId;
        $this->senderName = $senderName;
        $this->senderPic = $senderPic;
        $this->targetId = $targetId;
    }
    public function broadcastOn(): array
    {
        return [
            $this->targetId,
        ];
    }
    public function broadcastAs(): string
    {
        return 'notif';
    }
}
