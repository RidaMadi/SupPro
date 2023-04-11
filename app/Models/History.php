<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'histories';

    protected $fillable = [
         'id',
         'user_id',
         'action',
         'created_at',
    ];
}
