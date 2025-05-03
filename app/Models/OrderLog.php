<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderLog extends Model
{
    protected $fillable = [
        'order_id',
        'type',
        'payment_status',
        'status',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function getTypeLabelAttribute(): string
    {
        return match ($this->type) {
            1 => 'payment_status',
            2 => 'status',
        };
    }
}
