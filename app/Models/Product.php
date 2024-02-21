<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Category;
use App\Models\Image;
use App\Models\Color;
use App\Models\Brand;
use App\Models\Size;
use App\Models\ProductColor;
use App\Models\Type;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table="products";
    protected $fillable = [
        'name',
        'content',
        'price',
        'brand_id',
        'discount_amount',
        'discount_type',
        'meta_keyword',
        'meta_content',
        'meta_description',
        'short_description',
        'category_id',
        'type_id',
        'size_id',
        'material_id',
        'quantity',
        'color_id',
        'slug',
        'meta_title',

    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function preview(){
        return $this->hasOne(Image::class)
        ->where('is_preview',1);
    }
    public function productColors(){
        return $this->hasMany(ProductColor::class);
    }
    public function brand(){
        return $this->belongsTo(Brand::class);
    }
    public function size(){
        return $this->beLongsTo(Size::class);
    }
    public function material(){
        return $this->beLongsTo(Material::class);
    }
    public function type(){
        return $this->belongsTo(Type::class);
    }
    public function images(){
        return $this->hasMany(Image::class);
    }






}
