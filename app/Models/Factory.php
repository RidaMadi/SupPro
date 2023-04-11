<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factory extends Model
{
    use HasFactory;

    protected $table = 'factories';

    protected $fillable = [
         'id',
         'user_id',
         'id_city',
         'id_region',
         'name',
         'cost',
         'logo',
         'address',
         'location_x',
         'location_y',
         'active',
         'delete',
         'ad_price',
         'profit_ratio',
         'proCoin',
         'created_at',
    ];

    public function category() {
        //foreign_key, local_key
        return $this->hasMany( Category::class, 'factory_id', 'id' );
    }
}
