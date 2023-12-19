<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Order extends Mailable
{
    use Queueable, SerializesModels;
    public $id;

    /**
     * Create a new message instance.
     *
     * @param $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Оформлен заказ';
        $order = \App\Models\Order::find($this->id);
        
        if($order->address) {
            $street = \App\Models\Address::find($order->address);
        } else {
            $street = null;
        }
        
        return $this->subject($subject)->view('mail.order', compact('order', 'street'));
    }
}
