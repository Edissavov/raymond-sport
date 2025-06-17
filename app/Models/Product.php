<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $fillable = ['name' ,'slug','description','price','category_id'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function productSizes()
{
    return $this->hasMany(ProductSize::class);
}

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
