<?php

namespace App\Jobs;

use App\Mail\OrderFailed;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\OrderSuccess;
use App\Mail\PaymentSuccess;
use Illuminate\Support\Facades\Mail;
use App\Models\CustomerDepositPayment;
use Stripe\StripeClient;

class PayLater implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email, $order_id;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $order_id)
    {
        //
        $this->email = $email;
        $this->order_id = $order_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $stripe = new StripeClient(env('STRIPE_MY_TEST_KEY'));
        $order = CustomerDepositPayment::where('order_id', $this->order_id)->first();
        $charge = $stripe->charges->create([
            'customer' => $order['customer_id'],
            'currency' =>  'USD',
            'amount' => round($order['balance'] * 100),
            'description' => 'Remaining payment for order no ' . $order['order_id']
        ]);
        

        if ($charge['status'] === 'succeeded') {
            //update order status
            $update_order = $order->update([
                'balance_status' => 'success',
                'deposit_email_sent' => true,
            ]);
            // we send the payment success email
            $email = new PaymentSuccess($order->order_id);
            Mail::to($this->email)->send($email);

        }else{

            $email = new OrderFailed($$order->order_id);
            Mail::to($this->email)->send($email);            

        }
    }
}
