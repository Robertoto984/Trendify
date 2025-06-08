<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\{Size, Color, Image, Product, Category};
use App\Traits\WebResponse;
use Illuminate\Http\Request;
use App\Services\Backend\ProductService;
use Illuminate\Support\Facades\{Log, Storage};
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\{StoreProductRequest, UpdateProductRequest};

class ProductController extends Controller
{
    use WebResponse;

    public function __construct(private ProductService $service) {}

    public function index()
    {
        $products = $this->service->all();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        $colors = Color::select('id', 'name')->get();
        $sizes = Size::select('id', 'name')->get();
        return view('admin.products.create', compact(['categories', 'colors', 'sizes']));
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        $images = $request->allFiles()['images'] ?? [];

        try {
            $this->service->create($data, $images);
            return redirect()
                ->route('admin.products.index')
                ->with('success', 'تم إنشاء المنتج بنجاح');
        } catch (Exception $e) {
            Log::error(['create product error' => $e->getMessage()]);
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'حدث خطأ غير متوقع');
        }
    }


    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::select('id', 'name')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();

        if ($request->hasFile('images')) {
            $data['images'] = $request->file('images');
        }

        $this->service->update($product, $data);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'تم تحديث المنتج بنجاح');
    }


    public function destroy(Product $product)
    {
        $this->service->delete($product);
        return $this->redirectWithMessage('admin.products.index', 'Product deleted successfully');
    }

    public function destroyImage(Image $image)
    {
        if ($image->path && Storage::disk('public')->exists($image->path)) {
            Storage::disk('public')->delete($image->path);
        }

        $image->delete();

        return response()->json(['message' => 'تم الحذف بنجاح.']);
    }

    public function filterByCategory(Request $request)
    {
        $products = Product::with(['featuredImage', 'prices', 'variants.color', 'variants.size'])
            ->where('category_id', $request->category_id)->get();
        $view = view('products-list', compact('products'))->render();

        return response()->json(['html' => $view]);
    }

    public function filterFeaturedOrNew(Request $request)
    {
        $type = $request->type;

        $products = Product::with(['featuredImage', 'prices', 'variants.color', 'variants.size'])
            ->when($type === 'featured', fn($q) => $q->where('is_featured', true))
            ->when($type === 'new', fn($q) => $q->where('is_new', true))
            ->where('is_active', true)
            ->get();

        $view = view('products-list', compact('products'))->render();

        return response()->json(['html' => $view]);
    }
}
