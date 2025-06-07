<?php

namespace App\Services;

use Exception;
use App\Models\Product;
use Illuminate\Support\Arr;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    public function all()
    {
        return Product::select('id', 'category_id', 'name', 'is_featured', 'is_active')
            ->with([
                'category:id,name',
                'featuredImage'
            ])
            ->paginate(10);
    }

    public function create(array $data, array $images): Product
    {
        $storedPaths = [];

        try {
            return DB::transaction(function () use ($data, $images, &$storedPaths) {
                $productData = Arr::except($data, 'images');

                $product = Product::create([
                    'category_id'  => $productData['category_id'],
                    'name'         => $productData['name'],
                    'description'  => $productData['description'],
                    'is_featured'  => $productData['is_featured'],
                    'is_active'    => $productData['is_active'],
                ]);

                if (!empty($images)) {
                    $this->storeImages($product, $images, $storedPaths);
                }

                return $product;
            });
        } catch (Exception $e) {
            Log::error(['create product error' => $e->getMessage()]);

            foreach ($storedPaths as $path) {
                Storage::disk('public')->delete($path);
            }

            throw new Exception('فشل في إنشاء المنتج: ' . $e->getMessage());
        }
    }

    protected function storeImages(Product $product, array $images, array &$storedPaths): void
    {
        foreach ($images as $index => $file) {
            $path = $file->store("products", 'public');
            if (!$path) {
                throw new Exception("تعذّر رفع الصورة رقم {$index}.");
            }

            $storedPaths[] = $path;

            $product->images()->create([
                'path'        => $path,
                'is_featured' => ($index === 0),
            ]);
        }
    }

    public function update(Product $product, array $data): Product
    {
        return DB::transaction(function () use ($product, $data) {
            if (!empty($data['images']) && is_array($data['images'])) {
                $this->replaceImages($product, $data['images']);
            } elseif (isset($data['featured_image_id'])) {
                $product->images()->update(['is_featured' => false]);

                $product->images()
                    ->where('id', $data['featured_image_id'])
                    ->update(['is_featured' => true]);
            }
            $product->update(
                Arr::except($data, ['images', 'featured_image_id'])
            );

            return $product->refresh();
        });
    }


    public function replaceImages(Product $product, array $images): void
    {
        foreach ($product->images as $img) {
            Storage::disk('public')->delete($img->path);
            $img->delete();
        }

        foreach ($images as $index => $image) {
            $path = $image->store('products', 'public');

            $product->images()->create([
                'path' => $path,
                'is_featured' => $index === 0,
            ]);
        }
    }


    public function delete(Product $product): void
    {
        foreach ($product->images as $image) {
            if (Storage::disk('public')->exists($image->path)) {
                Storage::disk('public')->delete($image->path);
            }
        }

        $product->images()->delete();
        $product->delete();
    }
}
