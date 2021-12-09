<?php

namespace App\Models;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    public function brand()
    {
        return $this->BelongsTo(Brand::class);
    }

    public function orderedProduct()
    {
        return $this->belongsToMany(OrderdProduct::class);
    }
}
