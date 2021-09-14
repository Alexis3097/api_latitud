<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DiscountBoxEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $DiscountBox;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($DiscountBox)
    {
        $this-> DiscountBox = $DiscountBox;
    }
}
