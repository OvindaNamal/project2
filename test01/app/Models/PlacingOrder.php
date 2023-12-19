<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlacingOrder extends Model
{
    use HasFactory;
    protected $fillable=[
        'customer_name',
        'order_No',
        'pu_product',
        'product_code',
        'product_price',
        'quantity',
        'free',
        'discount',
        'amount',
        'net_Amount', // mean sub total amonunt
        'tot_discount',
        'tot_Amount',
        'pay',
        'balance'
    ];
}
