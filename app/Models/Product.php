<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name' ,'slug','description','price','stock','category_id'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_size')->withPivot('stock')->withTimestamps();
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
