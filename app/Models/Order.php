<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'orders';

    protected $fillable = [
         'id',
         'factory_id',
         'market_id',
         'task_id',
         'accept',
         'total_price',
         'time_for_delivery',
         'delivered',
         'created_at',
    ];
}
