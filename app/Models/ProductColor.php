<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Color;
use App\Models\Size;
use App\Models\Image;

class ProductColor extends Model
{
    use HasFactory;
    protected $fillable=[
        "product_id",
        "color_id",
        "quantity",
        "size_id",
        "image_id",

    ];
    public function color(){
        return $this->belongsTo(Color::class);
    }
    public function size(){
        return $this->beLongsTo(Size::class);
    }
    public function image(){
        return $this->beLongsTo(Image::class);
    }
}
