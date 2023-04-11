<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'product_orders';

    protected $fillable = [
            'id',
            'order_id',
            'product_id',
            'amount',
            'created_at',
    ];
}
