<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
         'id',
         'subCategory_id',
         'name',
         'photo',
         'price',
         'description',
         'created_at',
    ];
}
