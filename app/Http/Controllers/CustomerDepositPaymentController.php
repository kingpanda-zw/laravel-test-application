<?php

namespace App\Http\Controllers;

use App\Models\CustomerDepositPayment;
use Illuminate\Http\Request;

class CustomerDepositPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('customer-deposit-orders.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerDepositPayment  $customerDepositPayment
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerDepositPayment $customerDepositPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomerDepositPayment  $customerDepositPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerDepositPayment $customerDepositPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomerDepositPayment  $customerDepositPayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerDepositPayment $customerDepositPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerDepositPayment  $customerDepositPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerDepositPayment $customerDepositPayment)
    {
        //
    }
}
