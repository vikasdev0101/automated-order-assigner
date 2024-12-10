<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DeliveryBoy>
 */
class DeliveryBoyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'capacity' => $this->faker->numberBetween(1, 5),
            'available_at' => now(),
            'delivery_time' => 30, // 30 minutes
        ];
    }
}
