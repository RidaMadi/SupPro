<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;
    protected $table = 'Ads';

    protected $fillable = [
     'id',
     'factory_id',
     'title',
     'description',
     'photo',
     'active',
     'delete',
     'created_at',
    ];

}
