<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FactoryRole extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'factory_roles';

    protected $fillable = [
      'id',
      'role_name',
      'created_at',
    ];
}
