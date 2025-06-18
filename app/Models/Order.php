<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'total_price',
        'status',
        'shipping_address',
        'phone_number',
        'delivery_option'
    ];

    public const DELIVERY_ECONT = 'econt';
    public const DELIVERY_SPEEDY = 'speedy';

    public static $deliveryOptions = [
        self::DELIVERY_ECONT => 'Econt',
        self::DELIVERY_SPEEDY => 'Speedy'
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}