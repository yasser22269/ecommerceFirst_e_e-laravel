<?php

namespace App\Events;

use App\Models\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewOrder implements ShouldBroadcast
{
    //  implements ShouldBroadcast
    use Dispatchable, InteractsWithSockets, SerializesModels;

        public $order;

    public function __construct($order )
    {
        $this->order =$order;
    }


    public function broadcastOn()
    {
        return new Channel('ecommerceFirst_e_e');

    }

    public function broadcastWith()
    {

        return [
            'order_id' => $this->order->id,
            'order_total' => $this->order->total,
            'order_date' => $this -> order ->created_at,
            'user' =>[
                   'id'  => $this->order->user->id,
                   'name' => $this->order->user->name,
                   'phone' => $this->order->phone
            ]
        ];
    }
}
