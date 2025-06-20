<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'customer_name',
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
    public function updateTotal(): void
{
    $this->total_price = $this->items()->sum(DB::raw('quantity * price'));
    $this->save();
}
}