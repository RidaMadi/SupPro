<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'markets';

    protected $fillable = [
        'id',
        'user_id',
        'id_city',
        'id_region',
        'name',
        'type',
        'photo',
        'id_photo',
        'address',
        'location_x',
        'location_y',
        'active',
        'delete',
        'created_at',
    ];
}
