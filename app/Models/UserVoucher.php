<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Voucher;

class UserVoucher extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'voucher_id',
        'quantity'
    ];
    public function voucher(){
        return $this->belongsTo(Voucher::class);
    }

}