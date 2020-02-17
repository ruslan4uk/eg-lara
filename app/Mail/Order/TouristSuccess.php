<?php

namespace App\Mail\Order;

use App\Models\v2\Front\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TouristSuccess extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var
     */
    protected $order_id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order_id)
    {
        $this->order_id = $order_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Get order detail
        $order = Order::where('id', $this->order_id)
            ->with('tour')
            ->with('guide')
            ->first();

        return $this->view('mails.order.tourist-order')
            ->subject('Бронь экскурсии подтверждена')
            ->with([
                'data' => $order,
            ]);
    }
}
