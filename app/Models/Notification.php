<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'content',
        'status',
        'order_id'
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

}
