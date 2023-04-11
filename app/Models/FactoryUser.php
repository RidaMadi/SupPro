<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FactoryUser extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'factory_users';

    protected $fillable = [
        'id',
        'factory_id',
        'user_id',
        'created_at',
    ];
}
