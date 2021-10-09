<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [

        'product_category_id',
        'name',
        'image',
        'price',
        'created_by',

    ];

    public function product_category(){

        return $this->belongsTo('App\Models\ProductCategory');

    }
}
