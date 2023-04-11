<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationMarket extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'notification_markets';

    protected $fillable = [
        'id',
        'sender_id',
        'sender_name',
        'text',
        'photo',
        'created_at',
    ];
}
