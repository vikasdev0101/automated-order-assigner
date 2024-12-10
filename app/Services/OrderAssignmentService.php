<?php

namespace App\Services;

use App\Models\Order;
use App\Models\DeliveryBoy;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\OrderRepository;
use App\Repositories\DeliveryBoyRepository;

class OrderAssignmentService
{
    protected $orderRepository;
    protected $deliveryBoyRepository;

    public function __construct(OrderRepository $orderRepository, DeliveryBoyRepository $deliveryBoyRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->deliveryBoyRepository = $deliveryBoyRepository;
    }

    public function assignOrders()
    {
        Log::info('Starting order assignment process.');

        $availableBoys = $this->deliveryBoyRepository->getAvailableBoys();
        $assignedOrderIds = [];

        DB::transaction(function () use ($availableBoys, &$assignedOrderIds) {
            foreach ($availableBoys as $boy) {
                // Fetch pending orders for this iteration
                $orders = $this->orderRepository->getPendingOrders($assignedOrderIds, $boy->capacity);

                foreach ($orders as $order) {
                    DB::table('assign_order')->insert([
                        'delivery_boy_id' => $boy->id,
                        'order_id' => $order->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    Log::info("Assigned order ID {$order->id} to delivery boy {$boy->name}");

                    $assignedOrderIds[] = $order->id;
                }
                // Update delivery boy availability
                $this->deliveryBoyRepository->updateAvailability($boy->id, $boy->delivery_time);

            }

            // Mark assigned orders as "assigned" in bulk
            if (!empty($assignedOrderIds)) {
                $this->orderRepository->markOrdersAsAssigned($assignedOrderIds);
            }
        });

        Log::info('Order assignment process completed.');
    }
}
