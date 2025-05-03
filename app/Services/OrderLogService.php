<?php

namespace App\Services;

use App\Models\OrderLog;
use Illuminate\Support\Collection;

class OrderLogService
{
    public function all(): Collection
    {
        return OrderLog::with('order:id,order_number')
            ->select('id', 'order_id', 'type', 'payment_status', 'status')
            ->get();
    }

    public function create(array $data): OrderLog
    {
        return OrderLog::create($data);
    }

    public function update(OrderLog $orderLog, array $data): OrderLog
    {
        $orderLog->update($data);
        return $orderLog;
    }

    public function delete(OrderLog $orderLog): void
    {
        $orderLog->delete();
    }
}
