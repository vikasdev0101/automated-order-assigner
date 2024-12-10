<?php

namespace Database\Seeders;

use App\Models\DeliveryBoy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeliveryBoySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $deliveryBoys = [
            ['name' => 'A', 'capacity' => 2, 'delivery_time' => 30, 'available_at' => now()],
            ['name' => 'B', 'capacity' => 4, 'delivery_time' => 30, 'available_at' => now()],
            ['name' => 'C', 'capacity' => 5, 'delivery_time' => 30, 'available_at' => now()],
            ['name' => 'D', 'capacity' => 3, 'delivery_time' => 30, 'available_at' => now()],
        ];

        foreach ($deliveryBoys as $boy) {
            DeliveryBoy::create($boy);
        }
    }
}
