<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Order;
use App\Models\DeliveryBoy;

class OrderAssignmentControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_trigger_order_assignment_endpoint()
    {
        // Create delivery boys and pending orders
        DeliveryBoy::factory()->create(['name' => 'A', 'capacity' => 2]);
        Order::factory()->count(5)->create(['status' => 'pending']);

        // Make an API call to trigger the assignment
        $response = $this->postJson(route('trigger-order-assignment'));

        // Assert response
        $response->assertStatus(200);
        $response->assertJson(['message' => 'Order assignment process triggered successfully.']);

        // Verify database state
        $this->assertDatabaseCount('assign_order', 2);
    }
}
