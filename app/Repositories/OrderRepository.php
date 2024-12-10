<?php

namespace App\Repositories;

use App\Models\Order;
use InvalidArgumentException;
use Illuminate\Support\Facades\Log;
use App\Contracts\OrderRepositoryContract;
use Illuminate\Database\Eloquent\Collection;

class OrderRepository implements OrderRepositoryContract
{
    const DEFAULT_LIMIT = 100;

    public function getPendingOrders(array $assignedOrderIds, int $limit = self::DEFAULT_LIMIT): Collection
    {
        return Order::pending()->whereNotIn('id', $assignedOrderIds)->take($limit)->get();
    }

    public function markOrdersAsAssigned(array $orderIds): bool
    {
        if (empty($orderIds)) throw new InvalidArgumentException('Order IDs array cannot be empty');

        if (!array_filter($orderIds, 'is_int')) throw new InvalidArgumentException('Order IDs array must contain only integers');

        try {
            return Order::whereIn('id', $orderIds)->update(['status' => 'assigned']);
        } catch (\Exception $e) {
            // Handle database error
            Log::error($e->getMessage());
            return false;
        }
    }
}
