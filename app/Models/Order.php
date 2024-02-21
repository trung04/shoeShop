<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderProduct;
use App\Models\Ward;
use App\Models\District;
use App\Models\Province;

class Order extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'email',
        'phone',
        'phone2',
        'province_id',
        'ward_id',
        'address',
        'note',
        'payment_type',
        'total',
        'user_id',
        'status',
        'district_id',
        'sub_total',
        'tax'
    ];
    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }
    public function ward(){
        return $this->belongsTo(Ward::class);
    }
    public function district(){
        return $this->belongsTo(District::class);
    }
    public function Province(){
        return $this->belongsTo(Province::class);
    }
}
