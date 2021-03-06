<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
      'slug',
      'details',
      'price',
      'description',
      'cover_image',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
//
//    public function order()
//    {
//        return $this->belongsTo(Order::class);
//    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function presentPrice()
    {
        return '$' . sprintf('%01.2f', $this->price);
    }

    public function path()
    {
        return route('products.show', ['product' => $this->id, 'slug' => $this->name]);
    }

    public function scopeMightAlsoLike($query)
    {
        return $query->inRandomOrder()->take(4);
    }

    public function coverImage()
    {
        return '/storage/' . $this->cover_image;
    }

}
