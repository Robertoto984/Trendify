<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    protected $fillable = [
        'order_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'country',
        'post_code',
        'address1',
        'address2',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
