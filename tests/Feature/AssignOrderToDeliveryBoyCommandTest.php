<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Order;
use App\Models\DeliveryBoy;

class AssignOrderToDeliveryBoyCommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_assign_order_command_executes_successfully()
    {
        // Create delivery boys and pending orders
        DeliveryBoy::factory()->create(['name' => 'A', 'capacity' => 2]);
        Order::factory()->count(5)->create(['status' => 'pending']);

        // Execute the command
        $this->artisan('assign:order')
        ->expectsOutput('Starting the order assignment process...')
        ->expectsOutput('Orders have been assigned successfully.')
        ->assertExitCode(0);

        // Verify database state
        $this->assertDatabaseCount('assign_order', 2);
    }
}
