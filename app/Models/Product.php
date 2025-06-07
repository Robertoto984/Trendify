<?php

namespace App\Models;

use App\Traits\HasStatus;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasStatus;

    protected $preventLazyLoading = true;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'discount',
        'is_featured',
        'is_active',
        'stock',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function featuredImage()
    {
        return $this->morphOne(Image::class, 'imageable')
            ->where('is_featured', 1);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function uniqueColors()
    {
        return $this->variants()
            ->with('color')
            ->get()
            ->pluck('color')
            ->unique('id')
            ->values();
    }



    public function uniqueSizes()
    {
        return $this->variants()
            ->with('size')
            ->get()
            ->pluck('size')
            ->unique('id')
            ->values();
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
