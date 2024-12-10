<?php

namespace App\Repositories;

use App\Contracts\DeliveryBoyRepositoryContract;
use App\Models\DeliveryBoy;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

class DeliveryBoyRepository implements DeliveryBoyRepositoryContract
{

    public function getAvailableBoys(): Collection
    {
        return DeliveryBoy::available()->get();
    }

    /**
     * Updates the availability of a delivery boy.
     *
     * @param int $boyId The ID of the delivery boy.
     * @param int $deliveryTime The delivery time in minutes.
     *
     * @return bool True if the update was successful, false otherwise.
     */
    public function updateAvailability(int $boyId, int $deliveryTime): bool
    {
        return DeliveryBoy::where('id', $boyId)->update([
            'available_at' => Carbon::now()->addMinutes($deliveryTime),
        ]);
    }
}
