<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductColor;

class Size extends Model
{
    use HasFactory;
    protected $fillable=['size'];
    public function productColors(){
        return $this->hasMany(ProductColor::class);
    }
}
