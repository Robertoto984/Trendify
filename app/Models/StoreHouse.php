<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreHouse extends Model
{
    protected $fillable = [
        'product_id',
        'color_id',
        'size_id',
        'qty',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }
}
