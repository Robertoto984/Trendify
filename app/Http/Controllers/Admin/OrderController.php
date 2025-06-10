<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Traits\WebResponse;
use App\Services\OrderService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Http\Requests\Order\UpdateOrderRequest;

class OrderController extends Controller
{
    use WebResponse;

    public function __construct(private OrderService $service) {}

    public function index()
    {
        $orders = $this->service->all();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $users = User::select('id', 'name')->get();
        return view('orders.create', compact('users'));
    }

    public function store(StoreOrderRequest $request)
    {
        $this->service->create($request->validated());
        return $this->redirectWithMessage('orders.index', 'Order and its details created successfully');
    }


    public function show(Order $order)
    {
        $order->load('user:id,name,email');
        return view('orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $users = User::select('id', 'name')->get();
        return view('orders.edit', compact('order', 'users'));
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $this->service->update($order, $request->validated());
        return $this->redirectWithMessage('orders.index', 'Order updated successfully');
    }

    public function destroy(Order $order)
    {
        $this->service->delete($order);
        return $this->redirectWithMessage('orders.index', 'Order deleted successfully');
    }
}
