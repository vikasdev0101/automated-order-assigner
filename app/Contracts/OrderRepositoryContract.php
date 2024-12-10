<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface OrderRepositoryContract
{
    const DEFAULT_LIMIT = 100;

    /**
     * Retrieves a collection of pending orders.
     *
     * @param int $limit The maximum number of orders to retrieve.
     *
     * @return Collection A collection of pending orders.
     */
    public function getPendingOrders(array $assignedOrderIds, int $limit = self::DEFAULT_LIMIT): Collection;

    /**
     * Marks the specified orders as assigned.
     *
     * @param array $orderIds The IDs of the orders to mark as assigned.
     *
     * @return bool True if the orders were successfully marked as assigned, false otherwise.
     */
    public function markOrdersAsAssigned(array $orderIds): bool;

}
