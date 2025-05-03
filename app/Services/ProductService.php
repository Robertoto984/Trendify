<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;

class ProductService
{
    public function all(): Collection
    {
        return Product::select('id', 'category_id', 'name', 'description', 'price', 'discount', 'is_featured', 'is_active', 'stock', 'photo')
            ->with(['category:id,name'])
            ->get();
    }

    public function create(array $data): Product
    {
        return Product::create($data);
    }

    public function update(Product $product, array $data): Product
    {
        $product->update($data);
        return $product;
    }

    public function delete(Product $product): void
    {
        $product->delete();
    }
}
