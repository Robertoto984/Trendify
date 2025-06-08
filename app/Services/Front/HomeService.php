<?php

namespace App\Services\Front;

use App\Models\Banner;
use App\Models\Product;

class HomeService
{
    public function index()
    {
        $banners = Banner::select('id', 'title', 'description', 'status')
            ->with('images')
            ->latest()
            ->get();

        $featuredProducts = Product::with(['featuredImage', 'prices', 'variants.color', 'variants.size'])
            ->where(function ($query) {
                $query->where('is_featured', true)
                    ->orWhere('is_new', true);
            })
            ->where('is_active', true)
            ->get();


        return [
            'banners' => $banners,
            'featuredProducts' => $featuredProducts,
        ];
    }
}
