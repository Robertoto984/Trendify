<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Traits\WebResponse;
use App\Services\ProductService;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;

class ProductController extends Controller
{
    use WebResponse;

    public function __construct(private ProductService $service) {}

    public function index()
    {
        $products = $this->service->all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        return view('products.create', compact('categories'));
    }

    public function store(StoreProductRequest $request)
    {
        $this->service->create($request->validated());
        return $this->redirectWithMessage('products.index', 'Product created successfully');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::select('id', 'name')->get();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->service->update($product, $request->validated());
        return $this->redirectWithMessage('products.index', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        $this->service->delete($product);
        return $this->redirectWithMessage('products.index', 'Product deleted successfully');
    }
}
