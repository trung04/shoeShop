<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Image extends Model
{
    use HasFactory;
    protected $fillable=['path','is_preview','product_id'];
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
