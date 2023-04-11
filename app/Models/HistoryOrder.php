<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryOrder extends Model
{
    use HasFactory;

    protected $table = 'history_orders';

    protected $fillable = [
        'id',
        'factory_id',
        'market_id',
        'driver_id',
        'accept',
        'total_price',
        'time_for_delivery',
        'created_at'
    ];
}
