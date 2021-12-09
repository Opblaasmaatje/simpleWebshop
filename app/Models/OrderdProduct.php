<?php

namespace App\Models;

use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderdProduct extends Model
{
    use HasFactory;

    public function invoice()
    {
        return $this->BelongsTo(Invoice::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

}
