<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Product;
use App\Models\Brand;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=['name','slug','meta_title','meta_keyword','meta_description'];
    public function products(){
        return $this->hasMany(Product::class);
    }



}
