<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductSize extends Pivot
{
    public $incrementing = true;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }
}
