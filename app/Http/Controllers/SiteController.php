<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmail;
use App\Models\CustomerOrder;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderSuccess;

class SiteController extends Controller
{
    //
    public function welcome()
    {
        $categories = ProductCategory::limit(3)->get();
        $first_index = $categories->count() != 0 ? $categories->first()->id: '';
        $products = Product::all();
        return view('welcome', compact('categories', 'first_index', 'products'));
    }

    public function product_details($name)
    {

        $product = Product::where('slug', $name)->first();
        session(['product' => $product]);

        return view('product-details', compact('product'));
    }

    public function product_category($id)
    {

        $category = ProductCategory::whereId($id)->first();

        return view('product-category', compact('category'));
    }

    public function success_payment($order_id){

        //get customer
        $order = CustomerOrder::where('order_id', $order_id)->first();
        
        //update order status
        $order->update([
            'status' => 'success',
        ]);

        //take customer email and update order status

        try {

            SendEmail::dispatch($order->customer_email, $order->order_id);

        }catch(\Exception $e){


        }

        return view('success-payment');

    }

    public function failed_payment($order_id){

        //get customer
        $customer_order = CustomerOrder::where('order_id', $order_id)->first();
        
        //update order status
        $customer_order->update([
            'status' => 'failed',
        ]);

        return view('failed-payment');
    }
}
