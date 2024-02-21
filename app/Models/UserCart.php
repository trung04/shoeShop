<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Size;
use App\Models\Color;

class UserCart extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'quantity',
        'price',
        'path',
        'size_id',
        'color_id',
        'product_id',
        'user_id'
    ];
    public function size(){
        return $this->beLongsTo(Size::class);
    }
    public function color(){
        return $this->beLongsTo(Color::class);
    }

}