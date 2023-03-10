<?php

namespace App\Events\Event;

use App\Models\Event;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RegisterEventRecordEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $event;

    public $scenario;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Event $event, string $scenario)
    {
        $this->event = $event;

        $this->scenario = $scenario;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
