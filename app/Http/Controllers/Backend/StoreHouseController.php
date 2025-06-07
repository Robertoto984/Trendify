<?php

namespace App\Http\Controllers\Backend;

use App\Models\StoreHouse;
use Illuminate\Support\Facades\DB;
use App\Services\StoreHouseService;
use App\Http\Controllers\Controller;
use App\Models\{Product, Color, Size};
use App\Http\Requests\StoreHouse\StoreRequest;

class StoreHouseController extends Controller
{
    public function __construct(private StoreHouseService $service) {}

    public function index()
    {
        $products = Product::with([
            'storeHouses',
            'storeHouses.color',
            'storeHouses.size',
            'prices',
        ])
            ->withCount([
                'storeHouses as unique_colors_count' => function ($query) {
                    $query->select(DB::raw('COUNT(DISTINCT color_id)'));
                },
                'storeHouses as unique_sizes_count' => function ($query) {
                    $query->select(DB::raw('COUNT(DISTINCT size_id)'));
                },
            ])
            ->withSum('storeHouses as total_qty', 'qty')
            ->get();


        return view('admin.storeHouse.index', compact('products'));
    }

    public function create()
    {
        $products = Product::select('id', 'name')->get();
        $colors = Color::select('id', 'name')->get();
        $sizes = Size::select('id', 'name')->get();
        return view('admin.storeHouse.create', compact(['products', 'colors', 'sizes']));
    }

    public function store(StoreRequest $request)
    {
        $this->service->create($request->validated());

        return redirect()
            ->route('admin.store-house.index')
            ->with('success', 'تم إضافة المخزون بنجاح');
    }
}
