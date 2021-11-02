<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdateChange implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $status;
    public $user_id;
    public $active;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($status, $user_id, $active)
    {
        $this->status = $status;
        $this->user_id  = $user_id;
        $this->active = $active;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['mireavn'];
    }
}
