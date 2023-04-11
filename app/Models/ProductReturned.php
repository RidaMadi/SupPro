<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReturned extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'product_returneds';

    protected $fillable = [
      'id',
      'task_id',
      'order_id',
      'product_id',
      'amount',
      'created_at',
    ];
}
