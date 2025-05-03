<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'user_id',
        'discount',
        'total',
        'payment_method',
        'payment_status',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusLogsAttribute()
    {
        return OrderLog::where('order_id', $this->id)
            ->where('type', 2)
            ->orderByDesc('created_at')
            ->get();
    }

    public function getPaymentStatusLogsAttribute()
    {
        return OrderLog::where('order_id', $this->id)
            ->where('type', 1)
            ->orderByDesc('created_at')
            ->get();
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class);
    }

    public function orderLogs()
    {
        return $this->hasMany(OrderLog::class);
    }
}
