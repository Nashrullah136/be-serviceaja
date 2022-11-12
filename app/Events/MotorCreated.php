<?php

namespace App\Events;

use App\Models\Motor;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MotorCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $motor_id;

    public $purchase_date;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Motor $motor)
    {
        $this->motor_id = $motor->id;
        $this->purchase_date = $motor->purchase_date;
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
