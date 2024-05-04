<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrderProduct extends Model
{
    use HasFactory;
    protected $fillable = ['amount','order_id','product_id'];


    public function product():BelongsTo
    {
        return $this->belongsTo(Product::class);
    }



}
