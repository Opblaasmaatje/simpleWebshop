<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

        protected $fillable = [
        'id',
        'product_id',
        'amount',
        'invoice_id',
    ];

    Public function orderedProduct(){
        return $this->hasMany(OrderdProduct::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
