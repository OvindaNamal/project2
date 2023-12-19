<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefineFreeIssues extends Model
{
    use HasFactory;
    protected $fillable = [
        "label",
        "type",
        "product_code",
        "pu_product",
        "product_price",
        "free_product",
        "pu_quantity", 
        "free_quantity", 
        "lower_limit", 
        "upper_limit"
    ];
}
