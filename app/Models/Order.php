<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    public const STATUS_PENDING = 'pending';
    public const STATUS_PROCESSING = 'processing';
    public const STATUS_SHIPPED = 'shipped';
    public const STATUS_DELIVERED = 'delivered';
    public const STATUS_CANCELLED = 'cancelled';

    public static $statuses = [
        self::STATUS_PENDING => 'Pending',
        self::STATUS_PROCESSING => 'Processing',
        self::STATUS_SHIPPED => 'Shipped',
        self::STATUS_DELIVERED => 'Delivered',
        self::STATUS_CANCELLED => 'Cancelled',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function updateTotal(): void
    {
        $this->total_price = $this->items()->sum(DB::raw('quantity * price'));
        $this->save();
    }

    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->format('M d, Y \a\t h:i A');
    }

    public function getDeliveryOptionNameAttribute()
    {
        return self::$deliveryOptions[$this->delivery_option] ?? $this->delivery_option;
    }

    public function getStatusNameAttribute()
    {
        return self::$statuses[$this->status] ?? $this->status;
    }
}