<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\OrderAssignmentService;
use App\Models\Order;
use App\Models\DeliveryBoy;

class OrderAssignmentServiceTest extends TestCase
{
    use RefreshDatabase;

    protected OrderAssignmentService $orderAssignmentService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->orderAssignmentService = app(OrderAssignmentService::class);
    }

    public function test_assign_orders_distributes_orders_to_delivery_boys()
    {
        // Create delivery boys with specific capacities
        $deliveryBoys = DeliveryBoy::factory()->createMany([
            ['name' => 'A', 'capacity' => 2],
            ['name' => 'B', 'capacity' => 4],
            ['name' => 'C', 'capacity' => 5],
            ['name' => 'D', 'capacity' => 3],
        ]);

        // Create 10 pending orders
        $orders = Order::factory()->count(20)->create(['status' => 'pending']);

        // Run the assignment logic
        $this->orderAssignmentService->assignOrders();

        // Verify the assignments
        $this->assertDatabaseCount('assign_order', 14); // All orders should be assigned
        $this->assertEquals('assigned', $orders->fresh()->first()->status); // Orders status updated

        // Check if orders are distributed properly (capacity respected)
        $this->assertEquals(2, $deliveryBoys->firstWhere('name', 'A')->assignedOrders()->count());
        $this->assertEquals(4, $deliveryBoys->firstWhere('name', 'B')->assignedOrders()->count());
        $this->assertEquals(5, $deliveryBoys->firstWhere('name', 'C')->assignedOrders()->count());
        $this->assertEquals(3, $deliveryBoys->firstWhere('name', 'D')->assignedOrders()->count());
    }
}
