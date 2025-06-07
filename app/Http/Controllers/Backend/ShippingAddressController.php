<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order;
use App\Traits\WebResponse;
use App\Models\ShippingAddress;
use App\Http\Controllers\Controller;
use App\Services\ShippingAddressService;
use App\Http\Requests\ShippingAddress\StoreShippingAddressRequest;
use App\Http\Requests\ShippingAddress\UpdateShippingAddressRequest;

class ShippingAddressController extends Controller
{
    use WebResponse;

    public function __construct(private ShippingAddressService $service) {}

    public function index()
    {
        $addresses = $this->service->all();
        return view('shipping_addresses.index', compact('addresses'));
    }

    public function create()
    {
        $orders = Order::select('id', 'order_number')->get();
        return view('shipping_addresses.create', compact('orders'));
    }

    public function store(StoreShippingAddressRequest $request)
    {
        $this->service->create($request->validated());
        return $this->redirectWithMessage('shipping_addresses.index', 'Shipping address created successfully.');
    }

    public function show(ShippingAddress $shippingAddress)
    {
        $shippingAddress->load('order');
        return view('shipping_addresses.show', compact('shippingAddress'));
    }

    public function edit(ShippingAddress $shippingAddress)
    {
        $orders = Order::select('id', 'order_number')->get();
        return view('shipping_addresses.edit', compact('shippingAddress', 'orders'));
    }

    public function update(UpdateShippingAddressRequest $request, ShippingAddress $shippingAddress)
    {
        $this->service->update($shippingAddress, $request->validated());
        return $this->redirectWithMessage('shipping_addresses.index', 'Shipping address updated successfully.');
    }

    public function destroy(ShippingAddress $shippingAddress)
    {
        $this->service->delete($shippingAddress);
        return $this->redirectWithMessage('shipping_addresses.index', 'Shipping address deleted.');
    }
}
