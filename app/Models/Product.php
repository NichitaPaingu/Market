<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'category_type_id',
        'is_popular',
        'discount', 
    ];
    public function categoryType(){
        return $this->belongsTo(CategoryType::class);
    }
    public function images(){
        return $this->hasMany(ProductImage::class);
    }
    public function getDiscountedPriceAttribute()
    {
        if ($this->discount) {
            return $this->price * (1 - $this->discount / 100);
        }
        return $this->price;
    }
    public function favorites(){
        return $this->belongsToMany(User::class,'favorites');
    }
    public function reviews(){
        return $this->hasMany(Review::class);   
    }
}
