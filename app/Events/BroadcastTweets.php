<?php

namespace App\Events;

use Exception;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BroadcastTweets implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $tweet;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($tweet)
    {
        $this->tweet = $tweet;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('pusher-tweets');
    }

    public function broadcastAs() {
        return 'tweets';
    }
}
