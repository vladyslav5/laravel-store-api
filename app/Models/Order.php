<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['user_id'];
    public function order_products(): HasMany{
        return $this->hasMany(OrderProduct::class);
    }
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
