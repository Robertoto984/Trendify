<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderLog;
use App\Models\OrderDetails;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class OrderService
{
    public function all(): Collection
    {
        return Order::with('user:id,name,email')
            ->select('id', 'order_number', 'user_id', 'discount', 'total', 'payment_method', 'payment_status', 'status')
            ->get();
    }

    public function create(array $data): Order
    {
        $orderData = Arr::except($data, 'order_details');
        $orderData['order_number'] = 'ORD-' . time();

        $order = Order::create($orderData);

        // Create order details
        foreach ($data['order_details'] as $detail) {
            OrderDetails::create([
                'user_id' => $data['user_id'],
                'order_id' => $order->id,
                'product_id' => $detail['product_id'],
                'quantity' => $detail['quantity'],
                'price' => $detail['price'],
                'amount' => $detail['quantity'] * $detail['price'],
            ]);
        }

        // Log status if available
        if (!empty($order->status)) {
            OrderLog::create([
                'order_id' => $order->id,
                'type' => 2,
                'status' => $order->status,
            ]);
        }

        // Log payment_status if available
        if (!empty($order->payment_status)) {
            OrderLog::create([
                'order_id' => $order->id,
                'type' => 1,
                'payment_status' => $order->payment_status,
            ]);
        }

        return $order;
    }

    public function update(Order $order, array $data): Order
    {
        $original = $order->only(['status', 'payment_status']);

        $order->update($data);

        if (isset($data['status']) && $data['status'] !== $original['status']) {
            OrderLog::create([
                'order_id' => $order->id,
                'type' => 2,
                'status' => $data['status'],
            ]);
        }

        if (isset($data['payment_status']) && $data['payment_status'] !== $original['payment_status']) {
            OrderLog::create([
                'order_id' => $order->id,
                'type' => 1,
                'payment_status' => $data['payment_status'],
            ]);
        }

        return $order;
    }

    public function delete(Order $order): void
    {
        $order->delete();
    }
}
