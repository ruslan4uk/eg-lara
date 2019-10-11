<?php

namespace App\Events\Messenger;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewDialogEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var
     */
    public $dialog;
    /**
     * @var integer
     */
    public $user_to;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($dialog, $user_to)
    {
        $this->dialog = $dialog;
        $this->user_to = $user_to;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('messenger.' . $this->user_to);
    }

    /**
     * @return array
     */
    public function broadcastWith()
    {
        return ["dialog" => $this->dialog];
    }
}
