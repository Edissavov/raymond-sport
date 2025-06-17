<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $fillable = ['name'];

    public function productSizes()
    { 
        return $this->hasMany(ProductSize::class);
    }
}
