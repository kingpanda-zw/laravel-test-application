<?php

namespace App\Http\Livewire;

use App\Models\CustomerOrder;
use Livewire\Component;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Stripe\Exception\ApiErrorException;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class Checkout extends Component
{

    public $email, $name_on_card, $product_name, $product_price;

    public function render()
    {
        return view('livewire.checkout');
    }


    public function createSession(Request $request, Response $response)
    {
        $validateEmail = $this->validate([
            'email' => "required|email",
        ]);


        $product = session('product');
        $order_id = Str::random(10);

        //create order
        $create_order = CustomerOrder::create([
            'order_id' => $order_id,
            'customer_email' => $validateEmail['email'],
            'product_id' => $product->id,
            'status' => 'pending',
            'email_sent' => false,
        ]);

        if($create_order){

            $success_url = route('success-payment', $order_id);
            $failed_url = route('failed-payment', $order_id);
            // dd($product);
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $session = Session::create([
                'customer_email' => $validateEmail['email'],
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $product->name,
                            'images' => [$product->image],
                        ],
                        'unit_amount' => $product->price * 100,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => $success_url,
                'cancel_url' => $failed_url,
            ]);
    
            // dd("worked");
            // return $this->sendResponse($result, 'Session created successfully.');
            return redirect()->to($session->url);

        }

        
    }

}
