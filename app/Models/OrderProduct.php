<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class OrderProduct extends Model
{
    use HasFactory;
    protected $fillable=[
        'order_id',
        'product_id',
        'total_price',
        'quantity',
        'total',
        'size',
        'color',
        'path',
        'price'
    ];
    public function product(){
        return $this->belongsTo(Product::class);
    }


}
