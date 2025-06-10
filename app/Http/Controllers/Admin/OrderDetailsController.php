<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Traits\WebResponse;
use App\Models\OrderDetails;
use App\Http\Controllers\Controller;
use App\Services\OrderDetailService;
use App\Http\Requests\OrderDetails\StoreOrderDetailsRequest;
use App\Http\Requests\OrderDetails\UpdateOrderDetailsRequest;

class OrderDetailsController extends Controller
{
    use WebResponse;

    public function __construct(private OrderDetailService $service) {}

    public function index()
    {
        $orderDetails = $this->service->all();
        return view('order_details.index', compact('orderDetails'));
    }

    public function create()
    {
        return view('order_details.create', [
            'users' => User::select('id', 'name')->get(),
            'orders' => Order::select('id', 'order_number')->get(),
            'products' => Product::select('id', 'name')->get(),
        ]);
    }

    public function store(StoreOrderDetailsRequest $request)
    {
        $this->service->create($request->validated());
        return $this->redirectWithMessage('order_details.index', 'Order detail created successfully');
    }

    public function show(OrderDetails $orderDetail)
    {
        $orderDetail->load('user', 'order', 'product');
        return view('order_details.show', compact('orderDetail'));
    }

    public function edit(OrderDetails $orderDetail)
    {
        return view('order_details.edit', [
            'orderDetail' => $orderDetail,
            'users' => User::select('id', 'name')->get(),
            'orders' => Order::select('id', 'order_number')->get(),
            'products' => Product::select('id', 'name')->get(),
        ]);
    }

    public function update(UpdateOrderDetailsRequest $request, OrderDetails $orderDetails)
    {
        $this->service->update($orderDetails, $request->validated());
        return $this->redirectWithMessage('order_details.index', 'Order detail updated successfully');
    }

    public function destroy(OrderDetails $orderDetails)
    {
        $this->service->delete($orderDetails);
        return $this->redirectWithMessage('order_details.index', 'Order detail deleted');
    }
}
