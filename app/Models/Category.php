<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';

    protected $fillable = [
           'id',
           'factory_id',
           'name',
           'created_at',
    ];
    public function sub_category() {
        //foreign_key, local_key
        return $this->hasMany( SubCategory::class, 'category_id', 'id' );
    }
}
