<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'sub_categories';

    protected $fillable = [
        'id',
        'category_id',
        'name',
        'created_at',
    ];

    public function product() {
        //foreign_key, local_key
        return $this->hasMany( Product::class, 'subCategory_id', 'id' );
    }
}
