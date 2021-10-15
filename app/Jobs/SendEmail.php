<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderSuccess;
use App\Models\CustomerDepositPayment;
use App\Models\CustomerOrder;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email, $order_id, $is_deposit;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $order_id, $is_deposit)
    {
        //
        $this->email = $email;
        $this->order_id = $order_id;
        $this->is_deposit = $is_deposit;
        
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // we call the mail function to send email in queue
        $email = new OrderSuccess($this->order_id);
        Mail::to($this->email)->send($email);

        if($this->is_deposit){

            $order = CustomerDepositPayment::where('order_id', $this->order_id)->first();
            $update_order = $order->update([
                'email_sent' => true,
            ]);

        }else{
            $order = CustomerOrder::where('order_id', $this->order_id)->first();
            $update_order = $order->update([
                'email_sent' => true,
            ]);

        }
    }
}
