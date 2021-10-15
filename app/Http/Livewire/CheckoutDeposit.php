<?php

namespace App\Http\Livewire;

use App\Jobs\PayLater;
use App\Models\CustomerDepositPayment;
use App\Models\CustomerOrder;
use Livewire\Component;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Stripe\StripeClient;
use App\Jobs\SendEmail;

class CheckoutDeposit extends Component
{
    public $email, $name_on_card, $card_number, $expiry_year, $expiry_month, $cvc, $product_name, $product_price;
    public $hasSubmitted = false;

    public function render()
    {
        return view('livewire.checkout-deposit');
    }

    public function createSession(Request $request, Response $response)
    {
        $validateEmail = $this->validate([
            'email' => "required|email",
            'name_on_card' => "required|string",
            'card_number' => "required|numeric",
            'expiry_month' => "required|numeric|max:12",
            'expiry_year' => "required|numeric|min:21",
            'cvc' => "required|numeric"
        ]);

        $this->hasSubmitted = true;

        $product = session('product');
        $order_id = Str::random(10);

        //create order
        $create_order = CustomerDepositPayment::create([
            'order_id' => $order_id,
            'customer_email' => $validateEmail['email'],
            'product_id' => $product->id,
            'deposit' => (($product->price * 100) / 2) / 100,
            'balance' => (($product->price * 100) / 2) / 100,
            'deposit_status' => "pending",
            'balance_status' => 'pending',
            'email_sent' => false,
        ]);

        if ($create_order) {


            $stripe = new StripeClient(env('STRIPE_MY_TEST_KEY'));

            $token = $stripe->tokens->create([
                'card' => [
                    'number' => $this->card_number,
                    'exp_month' => $this->expiry_month,
                    'exp_year' => $this->expiry_year,
                    'cvc' => $this->cvc,
                ],
            ]);

            if (!isset($token['id'])) {

                session()->flash('The stripe token was not generated correctly');
                $this->hasSubmitted = false;
            }

            //create a stripe customer
            $customer = $stripe->customers->create([
                'name' => $this->name_on_card,
                'email' => $this->email,
                'source' => $token['id']
            ]);

            $charge = $stripe->charges->create([
                'customer' => $customer['id'],
                'currency' =>  'USD',
                'amount' => round($create_order['deposit'] * 100),
                'description' => 'Deposit payment for order no ' . $create_order->order_id
            ]);

            if ($charge['status'] === 'succeeded') {

                //update order
                $order = CustomerDepositPayment::where('order_id', $order_id)->first();
                try {

                    PayLater::dispatch($order->customer_email, $order->order_id)->delay(now()->addMinutes(2));
                    // ->delay(now()->addMinutes(1));

                } catch (\Exception $e) {

                    session()->flash('Failed to process payment. Please try again later');
                    $this->hasSubmitted = false;

                }

                $this->success_payment($create_order->order_id, $customer['id']);

            } else {

                $this->failed_payment($create_order->order_id, $customer['id']);
            }
        }
    }


    public function success_payment($order_id, $customer_id)
    {

        //get customer
        $order = CustomerDepositPayment::where('order_id', $order_id)->first();

        //update order status
        $order->update([
            'customer_id' => $customer_id,
            'deposit_status' => 'success',
        ]);

        //take customer email and update order status

        try {

            SendEmail::dispatch($order->customer_email, $order->order_id, true);
        } catch (\Exception $e) {
        }

        return redirect()->to("/deposit-successful");
    }

    public function failed_payment($order_id, $customer_id)
    {

        //get customer
        $customer_order = CustomerOrder::where('order_id', $order_id)->first();

        //update order status
        $customer_order->update([
            'customer_id' => $customer_id,
            'status' => 'failed',
        ]);

        return view('failed-payment');
    }
}
