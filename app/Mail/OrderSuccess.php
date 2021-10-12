<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderSuccess extends Mailable
{
    use Queueable, SerializesModels;
    public $order_id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order_id)
    {
        //
        $this->order_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $order_id = $this->order_id;
        return $this->subject('Order Success')->view('email-templates.success_payment', compact('order_id'));
    }
}
