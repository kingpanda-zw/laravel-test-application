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

class SendEmail implements ShouldQueue
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
        // we call the mail function to send email in queue
        $email = new OrderSuccess($this->order_id);
        Mail::to($this->email)->send($email);
    }
}
