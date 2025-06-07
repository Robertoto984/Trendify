<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $fillable = ['name'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function storeHouses()
    {
        return $this->hasMany(StoreHouse::class);
    }

    public function prices()
    {
        return $this->hasMany(ProductPrice::class);
    }
}
