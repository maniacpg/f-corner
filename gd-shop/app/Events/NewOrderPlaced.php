<?php

namespace App\Events;

use App\Models\Invoice;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class NewOrderPlaced implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $invoice;

    // Constructor nhận thông tin đơn hàng
    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;  // Gửi thông tin đơn hàng
    }

    // Kênh mà sự kiện sẽ được broadcast
    public function broadcastOn()
    {
        return new Channel('orders');  // Kênh "orders"
    }

    // Đặt tên sự kiện cho phía client lắng nghe
    public function broadcastAs()
    {
        return 'new-order';  // Tên sự kiện mà client sẽ lắng nghe
    }
}

