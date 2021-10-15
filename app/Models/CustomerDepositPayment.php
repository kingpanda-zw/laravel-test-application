<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerDepositPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'order_id',
        'customer_email',
        'customer_id',
        'product_id',
        'deposit',
        'balance',
        'deposit_status', 
        'balance_status',
        'email_sent',
        'deposit_email_sent',

    ];

    public function product(){

        return $this->belongsTo('App\Models\Product');

    }

}
