<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Stripe\Exception\ApiErrorException;

class StripeController extends Controller
{
    //
    public function createSession(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_KEY'));
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'T-shirt',
                    ],
                    'unit_amount' => 1000,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => 'https://example.com/success',
            'cancel_url' => 'https://example.com/cancel',
        ]);
        $result = [
            'sessionId' => $session['id'],
        ];
        return $this->sendResponse($result, 'Session created successfully.');
    }

    public function paymentSuccess(Request $request)
    {
        $sessionId = $request->get('session_id');
        // 
    }

    public function handleFailedPayment()
    {
        // 
    }
}
