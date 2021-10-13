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
        'product_id',
        'deposit',
        'balance',
        'status', 
        'email_sent',

    ];

    public function product(){

        return $this->belongsTo('App\Models\Product');

    }

}
