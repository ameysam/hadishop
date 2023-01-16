<?php

namespace App\Events\Meeting;

use App\Models\Meeting;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RegisterMeetingEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $meeting;

    public $scenario;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Meeting $meeting, string $scenario)
    {
        $this->meeting = $meeting;

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
