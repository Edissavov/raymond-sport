<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['order_id', 'product_id', 'size_id', 'quantity', 'price'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }
    protected static function booted()
{
    static::saved(function ($item) {
        $item->order->updateTotal();
    });

    static::deleted(function ($item) {
        $item->order->updateTotal();
    });
}
}
