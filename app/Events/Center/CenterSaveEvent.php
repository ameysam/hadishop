<?php

namespace App\Events\Center;

use App\Models\Center;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CenterSaveEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $center;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Center $center)
    {
        $this->center = $center;
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
